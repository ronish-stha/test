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

        Gate::define('isVerifiedSeller', function($user) {
            return $user->verified;
        });

        Gate::define('isSeller', function($user, $object) {
           return $user->id == $object->user->id;
        });

        Gate::define('isCustomer', function ($user, $object) {
            return $user->id == $object->user->id;
        });
    }
}
