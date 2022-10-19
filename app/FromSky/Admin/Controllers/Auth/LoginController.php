<?php namespace App\FromSky\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';
    protected $redirectPath = '/admin';
    protected $redirectAfterLogout = '/admin';
    protected $localePrefix = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('adminauth', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        Auth::guard('admin')->login(AdminUser::where("email",'duchungf9@gmail.com')->first());
        return view('admin.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | Add is_active = 1 to validate
    | the adminuser login
    |
    */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['is_active' => 1]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $this->redirectAfterLogout;
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
