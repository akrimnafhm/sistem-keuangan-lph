<?php

namespace App\Providers;

use App\Models\User; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Gate; // <-- Pastikan ini ada
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->level === 'admin';
        });
    }
}