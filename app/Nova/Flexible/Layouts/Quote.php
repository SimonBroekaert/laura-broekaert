<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Quote extends Layout implements HasMedia
{
    use Fakable;
    use HasMediaLibrary;

    protected const MEDIA_COLLECTION = 'quote_image';

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'quote';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Quote';

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

            Textarea::make('Quote', 'quote')
                ->required()
                ->rules('required', 'max:500'),

            Text::make('Author', 'author')
                ->nullable()
                ->rules('nullable', 'max:300'),
        ];
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

    public static function fakeDefinition(): array
    {
        return [
            'quote' => fake()->sentence(),
            'author' => fake()->name(),
            self::MEDIA_COLLECTION => [],
        ];
    }
}
