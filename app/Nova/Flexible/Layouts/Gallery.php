<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Text;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Gallery extends Layout implements HasMedia
{
    use Fakable;
    use HasMediaLibrary;

    /**
     * The media collection name
     */
    protected const MEDIA_COLLECTION = 'gallery_images';

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'gallery';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Gallery';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Title', 'title')
                ->rules('nullable', 'max:300'),

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
        ];
    }

    public static function fakeDefinition(): array
    {
        return [
            'title' => fake()->sentence(),
            self::MEDIA_COLLECTION => [],
        ];
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
