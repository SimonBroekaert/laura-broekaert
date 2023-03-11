<?php

namespace App\Nova;

use App\Enums\SessionStatus;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Session extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Session>
     */
    public static $model = \App\Models\Session::class;

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
    public static $title = 'datetime';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'datetime',
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

            BelongsTo::make('Plan', 'plan', Plan::class)
                ->rules('required')
                ->sortable(),

            Select::make('Status', 'status')
                ->rules('required')
                ->options(SessionStatus::labels())
                ->displayUsingLabels()
                ->default(SessionStatus::STATUS_PLANNED)
                ->onlyOnForms()
                ->filterable(),

            Badge::make('Status', 'status')
                ->labels(SessionStatus::labels())
                ->types(SessionStatus::badges())
                ->sortable()
                ->exceptOnForms(),

            BelongsTo::make('Client that declined', 'clientThatDeclined', Client::class)
                ->nullable()
                ->onlyOnDetail()
                ->showOnDetail(fn () => $this->status === SessionStatus::STATUS_DECLINED),

            DateTime::make('Date & Time', 'datetime')
                ->rules('required')
                ->sortable()
                ->datetimeFormat(),
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
