<?php

namespace Sigfriedseldeslachts\twiliosms;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TwilioSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Twilio', function()
        {
            return new \Sigfriedseldeslachts\twiliosms\Classes\Twilio;
        });
    }
}
