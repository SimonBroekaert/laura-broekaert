<?php

namespace App\Nova;

use App\Enums\PredefinedPage;
use App\Nova\Flexible\Presets\DefaultPreset;
use App\Nova\Flexible\Presets\HomePreset;
use App\Nova\Traits\HasDeveloperFields;
use App\Nova\Traits\HasTimestampFields;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Whitecube\NovaFlexibleContent\Flexible;

class Page extends Resource
{
    use HasDeveloperFields;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Page>
     */
    public static $model = \App\Models\Page::class;

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
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'developer_id',
    ];

    /**
     * Determine if the current user can delete the given resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function authorizedToDelete(Request $request)
    {
        return in_array($this->developer_id, PredefinedPage::cases());
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
                ->sortable()
                ->onlyOnDetail(),

            Text::make('Title', 'title')
                ->rules('required', 'max:255', 'unique:pages,title,{{resourceId}}')
                ->sortable(),

            Text::make('Slug', 'slug')
                ->rules('required', 'max:255', 'unique:pages,slug,{{resourceId}}')
                ->onlyOnDetail(),

            Flexible::make('Body', 'body')
                ->preset(match ($this->developer_id) {
                    PredefinedPage::PAGE_HOME->value => HomePreset::class,
                    default => DefaultPreset::class,
                }),

            Boolean::make('Online', 'is_online')
                ->default(true)
                ->sortable(),

            Panel::make('SEO', [
                Text::make('Title', 'seo_title')
                    ->rules('max:100')
                    ->hideFromIndex(),

                Text::make('Description', 'seo_description')
                    ->rules('max:300')
                    ->hideFromIndex(),

                Images::make('Image', 'seo_image')
                    ->hideFromIndex()
                    ->hideFromIndex(),
            ]),

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
