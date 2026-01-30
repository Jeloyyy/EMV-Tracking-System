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
            $dbFile = config('database.connections.sqlite.database');

            // If the configured path is absolute, use it; otherwise prefix with base_path()
            $isWindowsAbsolute = preg_match('/^[A-Za-z]:\\\\/', $dbFile ?? '');
            $isUnixAbsolute = isset($dbFile[0]) && ($dbFile[0] === '/');

            if ($isWindowsAbsolute || $isUnixAbsolute) {
                $dbPath = $dbFile;
            } else {
                $dbPath = base_path($dbFile);
            }

            // Ensure directory exists
            $dir = dirname($dbPath);
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            if (!File::exists($dbPath)) {
                File::put($dbPath, '');
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }
        }
    }
}