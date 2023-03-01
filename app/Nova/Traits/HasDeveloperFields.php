<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;

trait HasDeveloperFields
{
    public function developerFields(): array
    {
        if (! auth()->user()?->is_developer) {
            return [];
        }

        return [
            Heading::make('Developer Fields')
                ->hideFromIndex(),

            Text::make('Developer ID', 'developer_id')
                ->hideFromIndex(),
        ];
    }
}
