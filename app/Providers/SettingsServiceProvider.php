<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SettingsServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->first();

            if ($settings) {
                Config::set('mail.from.address', $settings->sender_email ?? config('mail.from.address'));
                Config::set('mail.from.name', $settings->title ?? config('mail.from.name'));

                Config::set('settings.contact_email', $settings->contact_email);
                Config::set('settings.notification_email', $settings->notification_email);
                Config::set('settings.phone', $settings->phone);
                view()->share('settings', $settings);
            }
        }
    }
}
