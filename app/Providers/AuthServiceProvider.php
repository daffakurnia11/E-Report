<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('admin', function (User $user) {
            return $user->roles == 'Admin';
        });
        Gate::define('gm', function (User $user) {
            return $user->roles == 'GM';
        });
        Gate::define('pm', function (User $user) {
            return $user->roles == 'PM';
        });
        Gate::define('pic', function (User $user) {
            return $user->roles == 'PIC';
        });
    }
}
