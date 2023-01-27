<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;

enum UserType: string
{
    use HasLabels;

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
