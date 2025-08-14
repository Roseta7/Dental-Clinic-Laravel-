<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware(['web', 'auth', 'role:admin'])
            ->prefix('dashboard/admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
        
        Route::middleware(['web', 'auth', 'role:dentist'])
            ->prefix('dashboard/dentist')
            ->name('dentist.')
            ->group(base_path('routes/dentist.php'));

        Route::middleware(['web', 'auth', 'role:nurse'])
            ->prefix('dashboard/nurse')
            ->name('nurse.')
            ->group(base_path('routes/nurse.php'));

        Route::middleware(['web', 'auth', 'role:receptionist'])
            ->prefix('dashboard/receptionist')
            ->name('receptionist.')
            ->group(base_path('routes/receptionist.php'));

        Route::middleware(['web', 'auth', 'role:accountant'])
            ->prefix('dashboard/accountant')
            ->name('accountant.')
            ->group(base_path('routes/accountant.php'));
    }
}
