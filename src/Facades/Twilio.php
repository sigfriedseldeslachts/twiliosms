<?php

namespace Sigfriedseldeslachts\twiliosms\Facades;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Facade;

class Twilio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Twilio';
    }
}
