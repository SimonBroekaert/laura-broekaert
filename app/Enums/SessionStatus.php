<?php

namespace App\Enums;

use App\Enums\Traits\HasBadges;
use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum SessionStatus: string
{
    use HasBadges;
    use HasLabels;
    use HasValues;

    case STATUS_CANCELLED = 'cancelled';
    case STATUS_DECLINED = 'declined';
    case STATUS_FINISHED = 'finished';
    case STATUS_PLANNED = 'planned';

    public function label(): string
    {
        return match ($this) {
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_DECLINED => 'Declined',
            self::STATUS_FINISHED => 'Finished',
            self::STATUS_PLANNED => 'Planned',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::STATUS_CANCELLED => novaBadgeColor('red'),
            self::STATUS_DECLINED => novaBadgeColor('orange'),
            self::STATUS_FINISHED => novaBadgeColor('green'),
            self::STATUS_PLANNED => novaBadgeColor('cyan'),
        };
    }
}
