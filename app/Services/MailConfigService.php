<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class MailConfigService
{
    public static function load()
    {
        Config::set('mail.mailer', setting('mail_mailer', env('MAIL_MAILER')));
        Config::set('mail.host', setting('mail_host', env('MAIL_HOST')));
        Config::set('mail.port', setting('mail_port', env('MAIL_PORT')));
        Config::set('mail.username', setting('mail_username', env('MAIL_USERNAME')));
        Config::set('mail.password', setting('mail_password', env('MAIL_PASSWORD')));
        Config::set('mail.encryption', setting('mail_encryption', env('MAIL_ENCRYPTION')));
        Config::set('mail.from.address', setting('mail_from_address', env('MAIL_FROM_ADDRESS')));
        Config::set('mail.from.name', setting('mail_from_name', env('MAIL_FROM_NAME')));
    }
}
