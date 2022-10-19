<?php

namespace App\FromSky\DomainLayer\User;

class UserFeatures
{

    /**
     * Determine if the given feature is enabled.
     *
     * @param string $feature
     * @return bool
     */
    public static function enabled(string $feature)
    {
        return in_array($feature, config('fromSky.website.users.features', []));
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     *
     * @param string $feature
     * @param string $option
     * @return bool
     */
    public static function optionEnabled(string $feature, string $option)
    {
        return static::enabled($feature) &&
            config("fromSky.website.users.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the application is allowing profile photo uploads.
     *
     * @return bool
     */
    public static function managesProfileAvatar()
    {
        return static::enabled(static::profileAvatar());
    }

    /**
     * Enable the profile photo upload feature.
     *
     * @return string
     */
    public static function profileAvatar()
    {
        return 'profile-avatar';
    }


    /**
     * Determine if the application is using any account deletion features.
     *
     * @return bool
     */
    public static function hasAccountDeletionFeatures()
    {
        return static::enabled(static::accountDeletion());
    }

    /**
     * Enable the account deletion feature.
     *
     * @return string
     */
    public static function accountDeletion()
    {
        return 'account-deletion';
    }

}