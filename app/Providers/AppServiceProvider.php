<?php

namespace App\Providers;

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
        // Auto-detect Railway MySQL environment variables
        if (env('MYSQLHOST') || env('DB_HOST')) {
            config([
                'database.default' => 'mysql',
                'database.connections.mysql.host' => env('MYSQLHOST', env('DB_HOST', '127.0.0.1')),
                'database.connections.mysql.port' => env('MYSQLPORT', env('DB_PORT', '3306')),
                'database.connections.mysql.database' => env('MYSQLDATABASE', env('DB_DATABASE', 'laravel')),
                'database.connections.mysql.username' => env('MYSQLUSER', env('DB_USERNAME', 'root')),
                'database.connections.mysql.password' => env('MYSQLPASSWORD', env('DB_PASSWORD', '')),
            ]);
        }

        // Use file-based session and cache in production (no extra DB tables needed)
        if (app()->environment('production')) {
            config([
                'session.driver' => 'file',
                'cache.default' => 'file',
            ]);
        }
    }
}
