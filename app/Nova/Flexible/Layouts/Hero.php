<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Text;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Hero extends Layout implements HasMedia
{
    use Fakable;
    use HasMediaLibrary;

    protected const MEDIA_COLLECTION = 'hero_image';

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
