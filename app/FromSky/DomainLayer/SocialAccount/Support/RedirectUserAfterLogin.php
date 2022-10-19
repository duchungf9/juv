<?php


namespace App\FromSky\DomainLayer\SocialAccount\Support;


trait RedirectUserAfterLogin
{
    protected string $redirectTo = '';// default redirect;

    function getRedirectAfterLogin()
    {
        if (request()->session()->has('redirectToAfterSocialLogin')) {
            $this->redirectTo = request()->session()->get('redirectToAfterSocialLogin');
        }

        request()->session()->forget('redirectToAfterSocialLogin');

        return $this->redirectTo;
    }



}