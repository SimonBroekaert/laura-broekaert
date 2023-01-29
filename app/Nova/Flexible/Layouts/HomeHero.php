<?php

namespace App\Nova\Flexible\Layouts;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Simonbroekaert\LinkPicker\Nova\Fields\LinkPicker;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class HomeHero extends Layout implements HasMedia
{
    use HasMediaLibrary;

    /**
     * The media collection name
     */
    protected const MEDIA_COLLECTION = 'home_hero_images';

    /**
     * The maximum amount of this layout type that can be added
     */
    protected $limit = 1;

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'home-hero';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Hero (Home)';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Images::make('Images (Upload 5)', self::MEDIA_COLLECTION)
                ->required()
                ->rules('required', 'size:5')
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
