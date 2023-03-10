<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PaymentMethod: string
{
    use HasLabels;
    use HasValues;

    case METHOD_CASH = 'cash';
    case METHOD_BANK_TRANSFER = 'bank-transfer';
    case METHOD_APP_PAYMENT = 'app-payment';

    public function label(): string
    {
        return match ($this) {
            self::METHOD_CASH => 'Cash',
            self::METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::METHOD_APP_PAYMENT => 'App Payment',
        };
    }
}
