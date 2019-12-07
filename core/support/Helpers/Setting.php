<?php

use Hydrogen\Setting\Models\Setting;

if (!function_exists('get_setting'))
{
    function get_setting($key)
    {
        $setting = Setting::where('key', $key)->first();

        if($setting != null)
        {
            return $setting->value;
        }

        return false;
    }
}