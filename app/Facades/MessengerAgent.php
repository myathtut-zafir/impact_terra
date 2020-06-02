<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MessengerAgent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MessengerAgent';
    }

}