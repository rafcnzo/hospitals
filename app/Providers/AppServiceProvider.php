<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

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
        // Custom Blade directive untuk @role
        Blade::if('role', function (string $role) {
            if (!Auth::check()) {
                return false;
            }
            
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            return $user->hasRole($role);
        });

        // Custom Blade directive untuk @hasanyrole
        Blade::if('hasanyrole', function (string|array $roles) {
            if (!Auth::check()) {
                return false;
            }
            
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            $rolesArray = is_array($roles) ? $roles : explode('|', $roles);
            
            foreach ($rolesArray as $role) {
                if ($user->hasRole(trim($role))) {
                    return true;
                }
            }
            
            return false;
        });

        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
