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
    case PAGE_COOKIE = 'cookie';
    case PAGE_INTERESTED = 'interested';
    case PAGE_PRIVACY = 'privacy';

    public function label(): string
    {
        return match ($this) {
            self::PAGE_HOME => 'Home',
            self::PAGE_CONTACT => 'Contact',
            self::PAGE_COOKIE => 'Cookie',
            self::PAGE_INTERESTED => 'Interested',
            self::PAGE_PRIVACY => 'Privacy',
        };
    }
}
