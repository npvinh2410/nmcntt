<?php

namespace Hydrogen\Media\Facades;

use Hydrogen\Media\HMedia;
use Illuminate\Support\Facades\Facade;

class HMediaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HMedia::class;
    }
}