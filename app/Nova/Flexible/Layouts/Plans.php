<?php

namespace App\Nova\Flexible\Layouts;

use App\Models\PlanType as ModelsPlanType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Plans extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'plans';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Plans';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Title', 'title')
                ->rules('nullable', 'max:255'),

            MultiSelect::make('Plan Types', 'plan_types')
                ->options(ModelsPlanType::all()->pluck('name', 'id'))
                ->displayUsingLabels()
                ->rules('required', 'min:1'),

            Tiptap::make('Note', 'note')
                ->rules('nullable')
                ->buttons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    '|',
                    'bulletList',
                    'orderedList',
                    '|',
                    'link',
                ])
                ->linkSettings([
                    'withFileUpload' => false,
                ]),

            Boolean::make('Show custom', 'show_custom')
                ->default(false),
        ];
    }

    /**
     * Attribute: first_button
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function firstButton(): Attribute
    {
        return Attribute::make(
            get: fn () => linkPicker()->button($this->button_1, $this->button_1_text),
        );
    }

    /**
     * Attribute: second_button
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function secondButton(): Attribute
    {
        return Attribute::make(
            get: fn () => linkPicker()->button($this->button_2, $this->button_2_text),
        );
    }
}
