<?php

namespace App\Nova;

use App\Enums\PlanStatus;
use App\Nova\Traits\HasPriceFields;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Plan extends Resource
{
    use HasPriceFields;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Plan>
     */
    public static $model = \App\Models\Plan::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Clients';

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
        'code',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->onlyOnDetail(),

            Select::make('Status', 'status')
                ->rules('required')
                ->options(PlanStatus::labels())
                ->displayUsingLabels()
                ->default(PlanStatus::STATUS_ACTIVE)
                ->onlyOnForms()
                ->filterable(),

            Badge::make('Status', 'status')
                ->labels(PlanStatus::labels())
                ->types(PlanStatus::badges())
                ->sortable()
                ->exceptOnForms(),

            Text::make('Name', 'name')
                ->sortable()
                ->readonly()
                ->exceptOnForms(),

            Text::make('Code', 'code')
                ->sortable()
                ->readonly()
                ->exceptOnForms(),

            Text::make('Clients', function () {
                // Create a comma separated list of clients with a link to the client
                return $this->clients->map(function ($client) {
                    return "<a class=\"link-default\" href=\"/admin/resources/clients/{$client->id}\">{$client->full_name}</a>";
                })->implode(',<br>');
            })
                ->asHtml()
                ->onlyOnIndex(),

            Heading::make('Location'),

            BelongsTo::make('Location')
                ->nullable()
                ->rules('required_if:external_location,null')
                ->hideFromIndex(),

            Text::make('External location', 'external_location')
                ->rules('required_if:location_id,null')
                ->hideFromIndex(),

            Heading::make('Settings'),

            Number::make('Amount of persons', 'amount_of_persons')
                ->rules('required', 'integer', 'min:1')
                ->min(1)
                ->step(1)
                ->hideFromIndex()
                ->displayUsing(function ($value) {
                    return $this->clients()->count() . '/' . $value;
                }),

            Number::make('Amount of sessions', 'amount_of_sessions')
                ->rules('required', 'integer', 'min:1')
                ->min(1)
                ->step(1)
                ->hideFromIndex(),

            BelongsToMany::make('Clients', 'clients', Client::class)
                ->hideFromIndex(),

            HasMany::make('Sessions', 'sessions', Session::class)
                ->hideFromIndex(),

            Heading::make('Progress'),

            Number::make('Sessions To Plan', 'unplanned_sessions_count')
                ->onlyOnDetail(),

            Number::make('Planned sessions', 'planned_sessions_count')
                ->onlyOnDetail(),

            Number::make('Finished sessions', 'finished_sessions_count')
                ->onlyOnDetail(),

            ...$this->priceFields(),
            ...$this->timestampFields(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
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
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
