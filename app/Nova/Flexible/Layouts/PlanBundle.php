<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class PlanBundle extends Layout
{
    use Fakable;

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'plan-bundle';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Plan Bundle';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Name', 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Currency::make('Price', 'price')
                ->sortable()
                ->rules('required', 'numeric', 'min:0')
                ->step(0.01)
                ->hideFromIndex(),

            Tiptap::make('Description', 'description')
                ->rules('nullable', 'max:255')
                ->buttons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                ]),
        ];
    }

    public static function fakeDefinition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'price' => fake()->randomFloat(2, 0, 100),
            'description' => fake()->text(100),
        ];
    }
}
