<?php namespace App\FromSky\Website\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\Website\Repos\Page\PageRepositoryInterface;

class LoginController extends Controller
{

    use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/users/dashboard';
    protected string $loginPath = '/users/login';
    protected string $redirectPath = '/users/dashboard';
//    protected string $redirectAfterLogout = '/users/login';
    protected string $redirectAfterLogout = '/social/google';
    protected $localePrefix = '';

    protected string $registerView = 'website.auth.register';
    /**
     * @var PageRepositoryInterface|string
     * TODO   will be  removed
     */
    protected $articleRepo = '';

    /**
     * Create a new authentication controller instance.
     * and  setup  some localized  variables
     *
     * @param PageRepositoryInterface $page
     */
    public function __construct(PageRepositoryInterface $page)
    {
        $this->articleRepo         = $page;
        $this->localePrefix        = get_locale();
        $this->redirectTo          = $this->localePrefix . '/users/dashboard';
        $this->redirectPath        = $this->localePrefix . '/users/dashboard';
        $this->loginPath           = $this->localePrefix . '/users/login';
        $this->redirectAfterLogout = $this->localePrefix . '/';
    }

    /**
     * Return the view to display
     * the page with login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        /*
         *  TODO   will  be  removed
         */
        $page = $this->articleRepo->getBySlug('login');
        $this->setSeo($page);
        return view('website.auth.login', compact('page'));
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate the current Locale
    | path prefix if needed
    |--------------------------------------------------------------------------
    | @return string
    |
    */
    protected function getRealLocale()
    {
        return (LaravelLocalization::getCurrentLocale() == LaravelLocalization::getDefaultLocale()) ? '' : '/' . LaravelLocalization::getCurrentLocale();
    }

    /*
    |--------------------------------------------------------------------------
    |
    |--------------------------------------------------------------------------
    |
    |
    */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        /*collect($request->session())->contains('login_web')->each(function($item, $key) use ($request) {

            if(Str::startsWith($key,'login_web')){
                $request->session()->forget($key);
            }
        });


        $request->session()->regenerateToken();*/

        return redirect($this->redirectAfterLogout);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);


        if ($request->redirectTo) {
            // If the redirect to path is in white list.
            if (in_array($request->redirectTo, config('fromSky.security.redirectTo')) == true) {
                $this->redirectTo = $request->redirectTo;
            }
        } // if store is disabled redirect to user profile page
        elseif (!StoreFeatures::isStoreEnabled()) {
            $this->redirectTo = 'users/profile';
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            if ($this->guard()->user()->isActive()) {
                return $this->sendLoginResponse($request);
            } else {
                $this->logout($request);
                $this->incrementLoginAttempts($request);
                return $this->sendInactiveUserLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendInactiveUserLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.unauthorized')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        if (StoreFeatures::isStoreEnabled())
            $cart = StoreHelper::getSessionCart();

        $request->session()->regenerate();

        // if the user has an active cart, store it to the new session
        if (StoreFeatures::isStoreEnabled()) {
            if ($cart) {
                $user = Auth::user();
                $cart->user()->associate($user);
                $cart->save();
                StoreHelper::setSessionCart($cart);
            } else {
                $cart = StoreHelper::getUserCart();
                if ($cart)
                    StoreHelper::setSessionCart($cart);
            }
        }

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
