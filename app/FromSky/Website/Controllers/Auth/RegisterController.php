<?php namespace App\FromSky\Website\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Model\User;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\Website\Repos\Page\PageRepositoryInterface;


/**
 * Class RegisterController
 * @package App\FromSky\Website\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;


    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var PageRepositoryInterface
     */
    protected $articleRepo;
    var $localePrefix;

    /**
     * RegisterController constructor.
     * @param PageRepositoryInterface $page
     */
    public function __construct(PageRepositoryInterface $page)
    {
        $this->middleware('guest');
        $this->localePrefix = get_locale();
        $this->redirectTo   = $this->localePrefix . '/';
        $this->articleRepo  = $page;

    }

    public function showRegistrationForm()
    {
        $page = $this->articleRepo->getBySlug('register');
        $this->setSeo($page);
        return view('website.auth.register', compact('page'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => ['required', 'string', 'confirmed', Password::defaults()],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'is_active' => 1,
            'email'     => $data['email'],
            'password'  => $data['password'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($request->redirectTo) {
            // If the redirect to path is in white list.
            if (in_array($request->redirectTo, config('fromSky.security.redirectTo')) == true) {
                $this->redirectTo = $request->redirectTo;
            }
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        // if the guet has an active cart, set it to his new user
        if (StoreFeatures::isStoreEnabled()) {
            $cart = StoreHelper::getSessionCart();
            if ($cart) {
                $cart->user()->associate($user);
                $cart->save();
                StoreHelper::setSessionCart($cart);
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
