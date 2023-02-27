<?php

namespace App\Nova;

use App\Nova\Traits\HasDeveloperFields;
use App\Nova\Traits\HasTimestampFields;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Manogi\Tiptap\Tiptap;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Plan extends Resource
{
    use HasDeveloperFields;
    use HasSortableRows;
    use HasTimestampFields;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Plan>
     */
    public static $model = \App\Models\Plan::class;

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
    public static $group = 'Plans';

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
        'name',
        'developer_id',
    ];

    /**
     * Handle any post-validation processing.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $planTypeId = $request->input('type_id');
        $planType = PlanType::newModel()->find($planTypeId);

        $uniqueNameValidator = Validator::make($request->only('name'), [
            'name' => [
                Rule::unique('plans', 'name')
                    ->where('plan_type_id', $planTypeId)
                    ->ignore($request->input('id')),
            ],
        ]);

        if ($uniqueNameValidator->fails()) {
            $validator->errors()->add('name', $uniqueNameValidator->errors()->first('name'));
        }

        $uniqueSlugValidator = Validator::make($request->only('slug'), [
            'slug' => [
                Rule::unique('plans', 'slug')
                    ->where('plan_type_id', $planTypeId)
                    ->ignore($request->input('id')),
            ],
        ]);

        if ($uniqueSlugValidator->fails()) {
            $validator->errors()->add('slug', $uniqueSlugValidator->errors()->first('slug'));
        }
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
                ->sortable()
                ->onlyOnDetail(),

            BelongsTo::make('Type', 'type', PlanType::class)
                ->rules('required')
                ->sortable(),

            Text::make('Name', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make('Slug', 'slug')
                ->rules('required', 'max:255')
                ->onlyOnDetail(),

            Tiptap::make('Description', 'description')
                ->rules('nullable', 'max:255')
                ->buttons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                ]),

            Number::make('Amount of sessions', 'amount_of_sessions')
                ->rules('required', 'integer', 'min:1')
                ->sortable(),

            Panel::make('Pricing', [
                Currency::make('Base Price', 'base_price')
                    ->sortable()
                    ->rules('required', 'numeric', 'min:0')
                    ->step(0.01)
                    ->hideFromIndex(),

                Number::make('Discount (%)', 'discount_percentage')
                    ->sortable()
                    ->rules('required', 'numeric', 'min:0', 'max:100')
                    ->step(0.01)
                    ->hideFromIndex()
                    ->displayUsing(fn ($value) => $value . '%'),

                Currency::make('Discount (€)', 'discount_amount')
                    ->sortable()
                    ->step(0.01)
                    ->exceptOnForms()
                    ->hideFromIndex(),

                Currency::make('Price With Discount', 'price_with_discount')
                    ->sortable()
                    ->rules('required', 'numeric', 'min:0')
                    ->step(0.01)
                    ->exceptOnForms()
                    ->hideFromIndex(),

                Number::make('Tax (%)', 'tax_percentage')
                    ->sortable()
                    ->rules('required', 'numeric', 'min:0', 'max:100')
                    ->step(0.01)
                    ->hideFromIndex()
                    ->displayUsing(fn ($value) => $value . '%'),

                Currency::make('Tax (€)', 'tax_amount')
                    ->sortable()
                    ->step(0.01)
                    ->exceptOnForms()
                    ->hideFromIndex(),

                Currency::make('Total Price', 'total_price')
                    ->sortable()
                    ->rules('required', 'numeric', 'min:0')
                    ->step(0.01)
                    ->exceptOnForms()
                    ->filterable(),
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
