<?php
namespace Hydrogen\Support;
use Illuminate\Support\Facades\File;

class Helper {

    public static function autoLoad($dir) {
        $helpers = File::glob($dir . '/*.php');
        foreach ($helpers as $h) {
            File::requireOnce($h);
        }
    }
}