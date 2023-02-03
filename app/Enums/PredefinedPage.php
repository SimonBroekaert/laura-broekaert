<?php

namespace App\Enums;

use App\Enums\Traits\HasValues;

enum PredefinedPage: string
{
    use HasValues;

    case PAGE_HOME = 'home';
    case PAGE_CONTACT = 'contact';
}
