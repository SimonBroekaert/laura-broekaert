<?php

namespace App\Enums;

use App\Enums\Traits\HasBadges;
use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum PlanStatus: string
{
    use HasBadges;
    use HasLabels;
    use HasValues;

    case STATUS_ACTIVE = 'active';
    case STATUS_CANCELLED = 'cancelled';
    case STATUS_EXPIRED = 'expired';
    case STATUS_FINISHED = 'finished';
    case STATUS_QUIT = 'quit';

    public function label(): string
    {
        return match ($this) {
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_FINISHED => 'Finished',
            self::STATUS_QUIT => 'Quit',
        };
    }

    public function ClientStatus(): ClientStatus
    {
        return match ($this) {
            self::STATUS_ACTIVE => ClientStatus::STATUS_ACTIVE,
            self::STATUS_CANCELLED => ClientStatus::STATUS_CANCELLED,
            self::STATUS_EXPIRED => ClientStatus::STATUS_ACTIVE,
            self::STATUS_FINISHED => ClientStatus::STATUS_FINISHED,
            self::STATUS_QUIT => ClientStatus::STATUS_QUIT,
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::STATUS_ACTIVE => novaBadgeColor('cyan'),
            self::STATUS_CANCELLED => novaBadgeColor('red'),
            self::STATUS_EXPIRED => novaBadgeColor('orange'),
            self::STATUS_FINISHED => novaBadgeColor('green'),
            self::STATUS_QUIT => novaBadgeColor('gray'),
        };
    }
}
