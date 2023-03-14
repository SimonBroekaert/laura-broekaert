<?php

namespace App\Nova;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Nova\Traits\HasPriceFields;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Payment extends Resource
{
    use HasPriceFields;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Payment>
     */
    public static $model = \App\Models\Payment::class;

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
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->onlyOnDetail(),

            Select::make('Status', 'status')
                ->rules('required')
                ->options(PaymentStatus::labels())
                ->displayUsingLabels()
                ->default(PaymentStatus::STATUS_PENDING)
                ->onlyOnForms()
                ->filterable(),

            Badge::make('Status', 'status')
                ->labels(PaymentStatus::labels())
                ->types(PaymentStatus::badges())
                ->sortable()
                ->exceptOnForms(),

            MorphTo::make('Payment For', 'payable')
                ->types([
                    Plan::class,
                ])
                ->filterable()
                ->hideFromIndex(),

            Text::make('Name', 'name')
                ->sortable()
                ->readonly()
                ->exceptOnForms(),

            Text::make('Code', 'code')
                ->sortable()
                ->readonly()
                ->exceptOnForms(),

            Select::make('Method', 'method')
                ->rules('required')
                ->options(PaymentMethod::labels())
                ->displayUsingLabels()
                ->default(PaymentMethod::METHOD_CASH)
                ->filterable(),

            ...$this->priceFields(),
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
