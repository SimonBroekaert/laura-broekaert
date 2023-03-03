<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum UserType: string
{
    use HasLabels;
    use HasValues;

    case TYPE_ADMIN = 'admin';
    case TYPE_DEVELOPER = 'developer';

    public function label(): string
    {
        return match ($this) {
            self::TYPE_ADMIN => 'Admin',
            self::TYPE_DEVELOPER => 'Developer',
        };
    }
}
