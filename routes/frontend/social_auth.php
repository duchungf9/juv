<?php

use App\FromSky\DomainLayer\SocialAccount\Controllers\SocialAuthController;
use App\FromSky\DomainLayer\SocialAccount\Controllers\RedirectToProviderController;

Route::group([], function () {
    Route::get('social_auth/{provider}',          RedirectToProviderController::class);
    Route::get('social_admin/google',          [RedirectToProviderController::class,'adminGoogleAuth'])->name("google_login_admin");
    Route::get('social_admin/github',          [RedirectToProviderController::class,'adminGithubAuth'])->name("github_login_admin");
    Route::get('social_auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
    Route::get('social_auth/{provider}/reset',    [SocialAuthController::class, 'reset']);
});