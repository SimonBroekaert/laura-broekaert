<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;

trait HasDeveloperFields
{
    public function developerFields(): array
    {
        return [
            Heading::make('Developer Fields')
                ->hideFromIndex(),

            Text::make('Developer ID', 'developer_id')
                ->hideFromIndex(),
        ];
    }
}
