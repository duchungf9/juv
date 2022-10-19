<?php

namespace App\FromSky\DomainLayer\SocialAccount\Controllers;

use App\Model\AdminUser;
use Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

use App\FromSky\DomainLayer\Store\Support\AddCartToUserAfterLogin;
use App\FromSky\DomainLayer\SocialAccount\Action\FindOrCreateUserAction;
use App\FromSky\DomainLayer\SocialAccount\Support\RedirectUserAfterLogin;

class SocialAuthController extends Controller
{
    use RedirectUserAfterLogin;
    use AddCartToUserAfterLogin;

    public function handleProviderCallback($provider)
    {

        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {

            return redirect('/login');
        }



        if(session()->has("login_admin") || 1==1){
            session()->forget("login_admin");
            $admin = AdminUser::where("email",$providerUser->email)->where("is_active",1)->first();

            if($admin != null){
                $this->redirectTo = route("admin_dashboard");
                auth()->guard("admin")->login($admin);
                return redirect($this->redirectTo);
            }
            session()->flash("err_mess","Admin account not found with " . $providerUser->email);
            return redirect()->route("admin.login");
        }
        $user             = (new FindOrCreateUserAction())->handle($providerUser, $provider);
        $this->redirectTo = $this->getRedirectAfterLogin();
        Auth::login($user, true);
        $this->addCartToLoggedUser($user);
        return redirect($this->redirectTo);
    }

    /* TODO */
    public function reset($provider): string
    {
        return "ok";
    }
}
