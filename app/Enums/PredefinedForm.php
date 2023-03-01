<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;

enum PredefinedForm: string
{
    use HasLabels;

    case FORM_CONTACT = 'contact';

    public function label(): string
    {
        return match ($this) {
            self::FORM_CONTACT => 'Contact',
        };
    }
}
