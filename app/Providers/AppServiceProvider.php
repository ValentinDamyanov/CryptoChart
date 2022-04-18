<?php

namespace App\Providers;

use App\Services\CryptoRateService;
use App\Services\Interfaces\CryptoRateInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CryptoRateInterface::class, function () {
            return new CryptoRateService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
