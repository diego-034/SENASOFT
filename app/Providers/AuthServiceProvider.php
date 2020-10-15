<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            if ($user->user_type == 1) {
                return true;
            }
            return false;
        });

        Gate::define('manager', function ($user) {
            if ($user->user_type == 2) {
                return true;
            }
            return false;
        });

        Gate::define('customer', function ($user) {
            if ($user->user_type == 3) {
                return true;
            }
            return false;
        });
    }
}
