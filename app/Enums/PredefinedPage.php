<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PredefinedPage: string
{
    use HasLabels;
    use HasValues;

    case PAGE_HOME = 'home';
    case PAGE_CONTACT = 'contact';
    case PAGE_PRIVACY = 'privacy';
    case PAGE_COOKIE = 'cookie';

    public function label(): string
    {
        return match ($this) {
            self::PAGE_HOME => 'Home',
            self::PAGE_CONTACT => 'Contact',
            self::PAGE_PRIVACY => 'Privacy',
            self::PAGE_COOKIE => 'Cookie',
        };
    }
}
