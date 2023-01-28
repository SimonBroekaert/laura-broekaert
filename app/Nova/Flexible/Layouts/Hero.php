<?php

namespace App\Nova\Flexible\Layouts;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Simonbroekaert\LinkPicker\Nova\Fields\LinkPicker;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Hero extends Layout implements HasMedia
{
    use HasMediaLibrary;

    /**
     * The maximum amount of this layout type that can be added
     */
    protected $limit = 1;

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'hero';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Hero';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Images::make('Image', 'image')
                ->required()
                ->rules('required')
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
     * Media: collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('public')
            ->singleFile();
    }
}
