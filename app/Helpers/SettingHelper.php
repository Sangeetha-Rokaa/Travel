<?php

use App\Models\SiteSetting;

function setting($key, $default = null)
{
    $value = SiteSetting::where('key', $key)->value('value');
    return $value ?? $default;
}
