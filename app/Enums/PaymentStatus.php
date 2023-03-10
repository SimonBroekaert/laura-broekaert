<?php

namespace App\Enums;

use App\Enums\Traits\HasBadges;
use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PaymentStatus: string
{
    use HasBadges;
    use HasLabels;
    use HasValues;

    case STATUS_CANCELLED = 'cancelled';
    case STATUS_PAID = 'paid';
    case STATUS_PENDING = 'pending';

    public function label(): string
    {
        return match ($this) {
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_PAID => 'Paid',
            self::STATUS_PENDING => 'Pending',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::STATUS_CANCELLED => novaBadgeColor('red'),
            self::STATUS_PAID => novaBadgeColor('green'),
            self::STATUS_PENDING => novaBadgeColor('yellow'),
        };
    }
}
