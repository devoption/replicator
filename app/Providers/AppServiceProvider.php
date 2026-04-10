<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Idea::class, IdeaPolicy::class);

        Gate::before(function (User $user): ?bool {
            return $user->isAn('admin') ? true : null;
        });

        Gate::define('access-admin', function (User $user): bool {
            return $user->isAn('admin');
        });
    }
}
