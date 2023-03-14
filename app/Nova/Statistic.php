<?php

namespace App\Nova;

use App\Enums\StatisticType;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Statistic extends Resource
{
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Statistic>
     */
    public static $model = \App\Models\Statistic::class;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'value';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'type',
        'value',
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

            BelongsTo::make('Client', 'client', Client::class)
                ->sortable()
                ->filterable(),

            Select::make(__('Type'), 'type')
                ->options(StatisticType::labels())
                ->displayUsingLabels()
                ->rules('required')
                ->sortable()
                ->filterable(),

            Text::make('Value', 'value')
                ->displayUsing(function ($value) {
                    $unit = match ($this->type) {
                        StatisticType::TYPE_WEIGHT => 'kg',
                        StatisticType::TYPE_HEIGHT => 'm',
                        default => null,
                    };

                    if ($unit) {
                        return "{$value}{$unit}";
                    }

                    return $value;
                }),

            MorphMany::make('Comments', 'comments', Comment::class),

            ...$this->timestampFields(),
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
