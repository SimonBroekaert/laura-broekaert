<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PredefinedForm: string
{
    use HasLabels;
    use HasValues;

    case FORM_CONTACT = 'contact';

    public function label(): string
    {
        return match ($this) {
            self::FORM_CONTACT => 'Contact',
        };
    }
}
