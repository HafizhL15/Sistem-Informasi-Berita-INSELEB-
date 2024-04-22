<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('SuperAdmin', function (User $user) {
            return $user->role_id == '1';
        });

        Gate::define('Admin', function (User $user) {
            return $user->role_id == '2';
        });

        Gate::define('Editor', function (User $user) {
            return $user->role_id == '3';
        });

        Gate::define('Author', function (User $user) {
            return $user->role_id == '4';
        });
    }
}
