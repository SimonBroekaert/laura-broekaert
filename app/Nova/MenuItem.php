<?php

namespace App\Nova;

use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;
use Simonbroekaert\LinkPicker\Nova\Fields\LinkPicker;

class MenuItem extends Resource
{
    use HasSortableRows;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MenuItem>
     */
    public static $model = \App\Models\MenuItem::class;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Site Builder';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'label';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'label',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Items';
    }

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

            BelongsTo::make('Menu', 'menu', Menu::class)
                ->sortable(),

            Text::make('Label')
                ->rules('required', 'max:255')
                ->sortable(),

            LinkPicker::make('Link')
                ->rules('required')
                ->sortable(),

            Boolean::make('Online', 'is_online')
                ->default(true)
                ->sortable(),

            Boolean::make('Opens in new tab', 'opens_in_new_tab')
                ->default(false)
                ->sortable(),

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
