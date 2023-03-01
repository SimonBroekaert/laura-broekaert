<?php

namespace App\Nova\Flexible\Layouts;

use App\Enums\PredefinedForm;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Form extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'form';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Form';

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

            Tiptap::make('Intro', 'intro')
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

            Select::make('Form', 'form')
                ->options(PredefinedForm::labels())
                ->rules('required'),
        ];
    }
}
