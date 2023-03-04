<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PredefinedForm: string
{
    use HasLabels;
    use HasValues;

    case FORM_CONTACT = 'contact';
    case FORM_INTERESTED = 'interested';

    public function label(): string
    {
        return match ($this) {
            self::FORM_CONTACT => 'Contact',
            self::FORM_INTERESTED => 'Interested',
        };
    }
}
