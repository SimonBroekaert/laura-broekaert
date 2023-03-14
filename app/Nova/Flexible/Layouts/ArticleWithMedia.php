<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Manogi\Tiptap\Tiptap;
use Simonbroekaert\LinkPicker\Nova\Fields\LinkPicker;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class ArticleWithMedia extends Layout implements HasMedia
{
    use Fakable;
    use HasMediaLibrary;

    /**
     * The media collection name
     */
    protected const MEDIA_COLLECTION = 'article_with_media_images';

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'article-with-media';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Article With Media';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Images::make('Images', self::MEDIA_COLLECTION)
                ->required()
                ->rules('required', 'min:1')
                ->conversionOnIndexView('thumb')
                ->conversionOnDetailView('thumb')
                ->conversionOnForm('thumb')
                ->conversionOnPreview('thumb')
                ->customPropertiesFields([
                    Text::make('Alt description', 'alt'),
                ])
                ->enableExistingMedia(),

            Text::make('Title', 'title')
                ->rules('nullable', 'max:255'),

            Tiptap::make('Body', 'body')
                ->rules('required')
                ->buttons([
                    'heading',
                    '|',
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

    public static function fakeDefinition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'button_1' => linkPicker()->fake(),
            'button_1_text' => fake()->word(),
            'button_2' => linkPicker()->fake(),
            'button_2_text' => fake()->word(),
            self::MEDIA_COLLECTION => [],
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
     * Attribute: images
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia(self::MEDIA_COLLECTION),
        );
    }
}
