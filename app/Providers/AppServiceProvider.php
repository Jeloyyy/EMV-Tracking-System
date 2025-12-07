<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('database.default') === 'sqlite' && app()->environment('local')) {
            $dbPath = config('database.connections.sqlite.database');

            if (!File::isAbsolutePath($dbPath)) {
                $dbPath = database_path($dbPath);
            }

            if (!File::exists($dbPath)) {
                File::put($dbPath, '');
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }
        }
    }
}
