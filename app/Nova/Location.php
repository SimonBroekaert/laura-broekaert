<?php

namespace App\Nova;

use App\Nova\Traits\HasDeveloperFields;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Location extends Resource
{
    use HasDeveloperFields;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Location>
     */
    public static $model = \App\Models\Location::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Locations';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'developer_id',
        'street',
        'street_number',
        'postal_code',
        'city',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->onlyOnDetail(),

            Text::make('Name', 'name')
                ->rules('required', 'max:255', 'unique:locations,name,{{resourceId}}')
                ->sortable(),

            Text::make('Slug', 'slug')
                ->rules('required', 'max:255', 'unique:locations,slug,{{resourceId}}')
                ->onlyOnDetail(),

            Text::make('Street', 'street')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Street Number', 'street_number')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Postal Code', 'postal_code')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('City', 'city')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Address', fn () => $this->address->full)
                ->onlyOnIndex(),

            ...$this->timestampFields(),
            ...$this->developerFields(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
