<?php namespace App\FromSky\Composer;

use App\Model\Setting;
use Cache;
use Illuminate\View\View;

/**
 * Class ViewShareSettingComposer
 * @package App\FromSky\Composer
 */
class ViewShareSettingComposer
{
    protected $site_settings;

    /**
     * Create a new ViewShareSettingComposer instance.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->site_settings = reGet(__METHOD__.'site_setting',function (){
            return Setting::select('value', 'key')->get()->pluck('value', 'key');
        });
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('site_settings', $this->site_settings);
    }
}