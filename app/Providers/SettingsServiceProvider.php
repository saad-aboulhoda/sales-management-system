<?php

namespace App\Providers;

use App\Models\GlobalSettings;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GlobalSettings::class, function () {
            return new GlobalSettings(Setting::all());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(GlobalSettings $instance): void
    {
        View::share('globalSettings', $instance);
    }
}
