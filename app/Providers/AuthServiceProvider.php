<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Admin;
use App\Member;

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

        Gate::define('is_admin', function($user)
        {
            return $user->role===User::USER_ROLE_ADMIN && $user->admin->level===Admin::ADMIN_LEVEL_ADMIN;
        });

        Gate::define('is_operator', function($user)
        {
            return $user->role===User::USER_ROLE_ADMIN && $user->admin->level===Admin::ADMIN_LEVEL_OPERATOR || $user->role===User::USER_ROLE_ADMIN;
        });

        Gate::define('is_himpunan', function($user)
        {
            return $user->role===User::USER_ROLE_MEMBER && $user->member->level===Member::MEMBER_LEVEL_ADMIN;
        });

        Gate::define('is_member', function($user)
        {
            return $user->role===User::USER_ROLE_MEMBER && $user->member->level===Member::MEMBER_LEVEL_OPERATOR || $user->role===User::USER_ROLE_MEMBER;
        });
       
    }
}
