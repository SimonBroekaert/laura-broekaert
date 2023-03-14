<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images as FieldImages;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Nova\Fields\Text;
use Spatie\MediaLibrary\HasMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasMediaLibrary;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Images extends Layout implements HasMedia
{
    use Fakable;
    use HasMediaLibrary;

    protected const MEDIA_COLLECTION = 'images';

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'images';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Image(s)';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            FieldImages::make('Images', self::MEDIA_COLLECTION)
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
