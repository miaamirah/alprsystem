<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Define Gates for roles
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('is-security', function ($user) {
            return $user->role === 'security';
        });
    }
}
