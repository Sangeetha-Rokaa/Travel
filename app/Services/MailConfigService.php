<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MailConfigService
{
    public static function load(): void
    {
        $settings = DB::table('email_settings')
            ->where('is_active', true)
            ->first();

        if (!$settings) {
            return; // no active config, keep .env values
        }

        if (!empty($settings->from_address)) {
            Config::set('mail.from.address', $settings->from_address);
        }

        if (!empty($settings->from_name)) {
            Config::set('mail.from.name', $settings->from_name);
        }

        if (!empty($settings->host)) {
            Config::set('mail.mailers.smtp.host',       $settings->host);
            Config::set('mail.mailers.smtp.port',       $settings->port);
            Config::set('mail.mailers.smtp.username',   $settings->username);
            Config::set('mail.mailers.smtp.password',   $settings->password);
            Config::set('mail.mailers.smtp.encryption', $settings->encryption);
            Config::set('mail.default',                 $settings->mailer);
        }
    }

    // Helper to get a single value from the active row
    public static function get(string $column, mixed $default = null): mixed
    {
        $settings = DB::table('email_settings')
            ->where('is_active', true)
            ->first();

        return $settings?->$column ?? $default;
    }
}
