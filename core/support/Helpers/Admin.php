<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('current_user')) {
    function current_user() {
        return Auth::user();
    }
}

if (!function_exists('current_user_id')) {
    function current_user_id() {
        return Auth::user()->id;
    }
}

if (!function_exists('hydrogen_authorize')) {
    function hydrogen_authorize($permissions, $flag = false, $both = false)
    {
        if($flag == false)
        {
            if (!current_user()->can($permissions, $both)) {
                abort(403);
            }
        }
        else
        {
            if (!current_user()->can($permissions, $both)) {
                return false;
            }
            else
            {
                return true;
            }
        }

    }
}
