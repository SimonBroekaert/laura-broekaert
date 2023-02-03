<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Heading;

trait HasTimestampFields
{
    public function timestampFields(): array
    {
        return [
            Heading::make('Timestamps')
                ->exceptOnForms()
                ->onlyOnDetail(),

            DateTime::make('Created At', 'created_at')
                ->onlyOnDetail()
                ->datetimeFormat(),

            DateTime::make('Updated At', 'updated_at')
                ->onlyOnDetail()
                ->datetimeFormat(),
        ];
    }
}
