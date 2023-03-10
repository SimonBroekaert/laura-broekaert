<?php

namespace App\Nova\Flexible\Layouts;

use App\Models\PredefinedPlan;
use App\Nova\Flexible\Layouts\Traits\Fakable;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Plans extends Layout
{
    use Fakable;

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

            MultiSelect::make('Plans', 'predefinedPlans')
                ->options(PredefinedPlan::all()->pluck('name', 'id'))
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
        ];
    }

    public static function fakeDefinition(): array
    {
        return [
            'title' => fake()->sentence(),
            'predefinedPlans' => PredefinedPlan::inRandomOrder()->pluck('id')->toArray(),
            'note' => fake()->paragraph(),
        ];
    }
}
