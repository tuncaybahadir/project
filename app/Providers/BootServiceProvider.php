<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BootServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (\Schema::hasTable('settings')) {
            $settings = \Setting::first();

            view()->share('settings', $settings);

            $root_dir = __DIR__.'/../../public/';
            if (isset($settings->system_email)) {
                \Config::set('mail.from', ['address' => $settings->system_email, 'name' => $settings->website_name]);
            }
        }
    }

    public function register()
    {
    }
}
