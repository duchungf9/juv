<?php namespace App\FromSky\Tools;

use App\Model\Setting;

/**
 * Class Setting
 * @package App\FromSky\Tools
 */
class SettingHelper
{

    /**
     * @param $key
     * @return mixed
     */
    static public function getOption($key)
    {
        $settingObj = Setting::firstWhere('Key', $key);
        return ($settingObj)
            ? $settingObj->value
            : '';
    }

    static public function getLocales()
    {
        return config('app.locales');
    }

}
