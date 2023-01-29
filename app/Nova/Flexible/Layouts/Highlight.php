<?php

namespace App\Nova\Flexible\Layouts;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Simonbroekaert\LinkPicker\Nova\Fields\LinkPicker;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Highlight extends Layout implements HasMedia
{
    use HasMediaLibrary;

    protected const MEDIA_COLLECTION = 'highlight_image';

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'highlight';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Highlight';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Images::make('Image', self::MEDIA_COLLECTION)
                ->required()
                ->rules('required')
                ->conversionOnIndexView('thumb')
                ->conversionOnDetailView('thumb')
                ->conversionOnForm('thumb')
                ->conversionOnPreview('thumb')
                ->customPropertiesFields([
                    Text::make('Alt description', 'alt'),
                ])
                ->enableExistingMedia(),

            Text::make('Title', 'title')
                ->rules('required', 'max:300'),

            Tiptap::make('Body', 'body')
                ->rules('required')
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
                ->headingLevels([3])
                ->linkSettings([
                    'withFileUpload' => false,
                ]),

            Heading::make('Button 1'),

            LinkPicker::make('Link', 'button_1')
                ->nullable(),

            Text::make('Text', 'button_1_text')
                ->nullable(),

            Heading::make('Button 2'),

            LinkPicker::make('Link', 'button_2')
                ->nullable(),

            Text::make('Text', 'button_2_text')
                ->nullable(),
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

    /**
     * Attribute: image
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia(self::MEDIA_COLLECTION),
        );
    }
}
