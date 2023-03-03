<?php

namespace App\Enums;

use App\Enums\Traits\HasBadges;
use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum ClientStatus: string
{
    use HasBadges;
    use HasLabels;
    use HasValues;

    case STATUS_ACTIVE = 'active';
    case STATUS_CANCELLED = 'cancelled';
    case STATUS_FINISHED = 'finished';
    case STATUS_INTERESTED = 'interested';
    case STATUS_QUIT = 'quit';

    public function label(): string
    {
        return match ($this) {
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_FINISHED => 'Finished',
            self::STATUS_INTERESTED => 'Interested',
            self::STATUS_QUIT => 'Quit',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::STATUS_ACTIVE => novaBadgeColor('cyan'),
            self::STATUS_CANCELLED => novaBadgeColor('red'),
            self::STATUS_FINISHED => novaBadgeColor('green'),
            self::STATUS_INTERESTED => novaBadgeColor('yellow'),
            self::STATUS_QUIT => novaBadgeColor('gray'),
        };
    }
}
