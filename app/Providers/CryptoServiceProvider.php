<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;

class CryptoServiceProvider extends ServiceProvider
{
        public function register()
        {
            $this->app->singleton('App\Services\Interfaces\CryptoRateInterface', config('crypto.service'));
        }
}
