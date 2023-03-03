<?php

namespace App\Nova;

use App\Nova\Actions\CreateClientFromContactFormEntry;
use App\Nova\Traits\HasTimestampFields;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ContactFormEntry extends Resource
{
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ContactFormEntry>
     */
    public static $model = \App\Models\ContactFormEntry::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Contact';

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
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Form Entries';
    }

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

            Text::make('First Name', 'first_name')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Last Name', 'last_name')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Full Name', 'full_name')
                ->readonly()
                ->onlyOnIndex()
                ->sortable(),

            Text::make('Email', 'email')
                ->sortable()
                ->rules('required', 'max:255', 'email'),

            Text::make('Phone', 'phone')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Subject', 'subject')
                ->rules('required', 'max:255')
                ->sortable(),

            Textarea::make('Message', 'message')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

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
        return [
            CreateClientFromContactFormEntry::make(),
        ];
    }
}
