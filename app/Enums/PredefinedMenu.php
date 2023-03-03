<?php

namespace App\Enums;

use App\Enums\Traits\HasValues;

enum PredefinedMenu: string
{
    use HasValues;

    case MENU_MAIN = 'main';
    case MENU_LEGAL = 'legal';
}
