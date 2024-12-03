<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public static array $optimizeCommands = [
        'filament-optimize' => 'filament:optimize',
        'filament-assets'   => 'filament:assets',
    ];

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        //
    }
}
