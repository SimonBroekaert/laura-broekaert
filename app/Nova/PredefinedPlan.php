<?php

namespace App\Nova;

use App\Nova\Flexible\Layouts\PlanBundle;
use App\Nova\Traits\HasDeveloperFields;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;
use Outl1ne\NovaSortable\Traits\HasSortableRows;
use Whitecube\NovaFlexibleContent\Flexible;

class PredefinedPlan extends Resource
{
    use HasDeveloperFields;
    use HasSortableRows;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PredefinedPlan>
     */
    public static $model = \App\Models\PredefinedPlan::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'General';

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
                ->sortable()
                ->onlyOnDetail(),

            Text::make('Name', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make('Slug', 'slug')
                ->rules('required', 'max:255')
                ->onlyOnDetail(),

            Flexible::make('Bundles', 'bundles')
                ->nullable()
                ->addLayout(PlanBundle::class)
                ->button('Add Bundle'),

            Tiptap::make('Description', 'description')
                ->rules('nullable', 'max:255')
                ->buttons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                ]),

            Boolean::make('Online', 'is_online')
                ->default(true)
                ->sortable()
                ->filterable(),

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
