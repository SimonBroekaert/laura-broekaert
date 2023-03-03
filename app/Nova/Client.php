<?php

namespace App\Nova;

use App\Enums\ClientStatus;
use App\Nova\Traits\HasTimestampFields;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Client>
     */
    public static $model = \App\Models\Client::class;

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
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'full_name',
        'email',
        'phone',
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
                ->options(ClientStatus::labels())
                ->displayUsingLabels()
                ->default(ClientStatus::STATUS_ACTIVE)
                ->onlyOnForms(),

            Badge::make('Status', 'status')
                ->labels(ClientStatus::labels())
                ->types(ClientStatus::badges())
                ->sortable()
                ->exceptOnForms(),

            Text::make('First Name', 'first_name')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Last Name', 'last_name')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Full Name', 'full_name')
                ->rules('required', 'max:255')
                ->onlyOnIndex(),

            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255', 'unique:clients,email,{{resourceId}}')
                ->sortable(),

            Text::make('Phone', 'phone')
                ->rules('nullable', 'max:255', 'unique:clients,phone,{{resourceId}}')
                ->sortable(),

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
