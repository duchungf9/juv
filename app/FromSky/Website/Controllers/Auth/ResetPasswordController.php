<?php namespace App\FromSky\Website\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\FromSky\Website\Repos\Page\PageRepositoryInterface;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Override Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/users/dashboard';
    protected $redirectPath = '/users/dashboard';
    public $localePrefix;
    use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;

    protected $articleRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepositoryInterface $page)
    {
        $this->middleware('guest');
        $this->localePrefix = get_locale();
        $this->redirectTo   = $this->localePrefix . '/users/dashboard';
        $this->redirectPath = $this->localePrefix . '/users/dashboard';
        $this->articleRepo  = $page;
    }

    public function showResetForm(Request $request, $token = null)
    {
        $page = $this->articleRepo->getBySlug(config('fromSky.website.option.auth.default_page'));

        $this->setSeo($page);
        \SEO::setTitle(trans(trans('message.password_reset')));

        return view('website.auth.reset')->with(
            ['token' => $token, 'email' => $request->email, 'page' => $page]
        );
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        if ($response == 'passwords.user') {
            $response = "passwords.invalid";
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password'       => $password,
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
}
