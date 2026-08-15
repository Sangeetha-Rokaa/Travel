<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Destination;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use App\Models\SiteSetting;

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
        View::composer('*', function ($view) {

            $destinations = Destination::active()
                ->ordered()
                ->get();

            $view->with('destinations', $destinations);
        });
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        Config::set('mail.mailer', $settings['mail_mailer'] ?? env('MAIL_MAILER'));
        Config::set('mail.host', $settings['mail_host'] ?? env('MAIL_HOST'));
        Config::set('mail.port', $settings['mail_port'] ?? env('MAIL_PORT'));
        Config::set('mail.username', $settings['mail_username'] ?? env('MAIL_USERNAME'));
        Config::set('mail.password', $settings['mail_password'] ?? env('MAIL_PASSWORD'));
        Config::set('mail.encryption', $settings['mail_encryption'] ?? env('MAIL_ENCRYPTION'));
        Config::set('mail.from.address', $settings['mail_from_address'] ?? env('MAIL_FROM_ADDRESS'));
        Config::set('mail.from.name', $settings['mail_from_name'] ?? env('MAIL_FROM_NAME'));
    }
}
