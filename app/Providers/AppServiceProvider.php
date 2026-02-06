<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

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
        // Only run this in local environment with SQLite
        if (config('database.default') === 'sqlite' && app()->environment('local')) {
            $dbFile = config('database.connections.sqlite.database');

            // If DB path is relative, resolve it against base_path()
            if (!str_starts_with($dbFile, '/')) {
                $dbFile = base_path($dbFile);
            }

            // Ensure directory exists
            $dir = dirname($dbFile);
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            // Ensure SQLite file exists
            if (!File::exists($dbFile)) {
                File::put($dbFile, '');
                // Run migrations and seed automatically
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }
        }
    }
}