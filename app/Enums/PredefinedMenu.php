<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PredefinedMenu: string
{
    use HasLabels;
    use HasValues;

    case MENU_MAIN = 'main';
    case MENU_LEGAL = 'legal';

    public function label(): string
    {
        return match ($this) {
            self::MENU_MAIN => 'Main',
            self::MENU_LEGAL => 'Legal',
        };
    }
}
