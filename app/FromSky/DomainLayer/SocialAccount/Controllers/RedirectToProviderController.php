<?php

namespace App\FromSky\DomainLayer\SocialAccount\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectToProviderController extends Controller
{

    public function __invoke($provider, Request $request)
    {
        if ($request->has('redirectTo')) {
            $request->session()->put('redirectToAfterSocialLogin', $request->get('redirectTo'));
        } else $request->session()->forget('redirectToAfterSocialLogin');

        return Socialite::driver($provider)->redirect();
    }

    public function adminGoogleAuth(){
        session()->put("login_admin" , true);
        request()->session()->save();

        return Socialite::driver("google")->redirect();
    }

    public function adminGithubAuth(){
        session()->put("login_admin" , true);
        request()->session()->save();
        return Socialite::driver("github")->redirect();
    }
}
