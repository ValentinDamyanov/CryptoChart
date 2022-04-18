<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Generate a Policy class name in the App\Policies namespace
         *
         * 1) keep the model heirarchy if it is App\Models:
         *    example: App\Models\Foo\Bar -> App\Policies\Foo\BarPolicy
         *
         * 2) fallback and provide App\Policies for non-App\Models:
         *    example: App\User -> App\Policies\UserPolicy
         */
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return Str::startsWith($modelClass, 'App\Models')
                ? 'App\Policies\\' . str_replace('App\Models\\', '', $modelClass) . 'Policy'
                : 'App\Policies\\' . class_basename($modelClass) . 'Policy';
        });
    }
}
