<?php

namespace App\Models;

use App\Casts\FlexibleCast;
use App\Enums\PredefinedPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'developer_id',
        'title',
        'slug',
        'body',
        'is_online',
        'seo_title',
        'seo_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'body' => FlexibleCast::class,
        'is_online' => 'boolean',
    ];

    /**
     * Get the options for generating the slug.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->resolveRouteBindingQuery($this, $value, $field)
            ->online()
            ->notPredefined()
            ->first();
    }

    /**
     * Media: collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('seo_image')
            ->useDisk('public')
            ->singleFile();
    }

    /**
     * Media: conversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        // Add thumb media conversion for all media
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 250, 250);

        // Add Conversions for the Layout Builder Home-hero block images
        $this->addHomeHeroBlockConversions($media);

        // Add Conversions for the Layout Builder Hero block images
        $this->addHeroBlockConversions($media);

        // Add Conversions for the Layout Builder Article with media block images
        $this->addArticleWithMediaBlockConversions($media);

        // Add Conversions for the Layout Builder Image block images
        $this->addImageBlockConversions($media);

        // Add Conversions for the Layout Builder Highlight block images
        $this->addHighlightBlockConversions($media);

        // Add Conversions for the Layout Builder Quote block images
        $this->addQuoteBlockConversions($media);
    }

    /**
     * Scope: linkPicker.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeLinkPicker($query): Builder
    {
        return $query->notPredefined();
    }

    /**
     * Scope: notPredefined.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeNotPredefined($query): Builder
    {
        return $query
            ->where(function (Builder $query) {
                $query->whereNull('developer_id')
                    ->orWhereNotIn('developer_id', PredefinedPage::values());
            });
    }

    /**
     * Scope: online.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeOnline($query): Builder
    {
        return $query->where('is_online', true);
    }

    /**
     * Attribute: url.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('pages.show', $this),
        );
    }

    /**
     * Attribute: seo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function seo(): Attribute
    {
        return Attribute::make(
            get: fn () => (object) [
                'title' => $this->seo_title,
                'description' => $this->seo_description,
                'image' => $this->getFirstMediaUrl('seo_image'),
            ],
        );
    }

    /**
     * Method: addHomeHeroBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addHomeHeroBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'home_hero_images_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('home-hero-portrait')
            ->fit(Manipulations::FIT_CROP, 800, 1425)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('home-hero-portrait-webp')
            ->fit(Manipulations::FIT_CROP, 800, 1425)
            ->format('webp')
            ->withResponsiveImages();

        // Crop the image to a 16:9 ratio and add responsive images
        $this->addMediaConversion('home-hero-landscape')
            ->fit(Manipulations::FIT_CROP, 1425, 800)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('home-hero-landscape-webp')
            ->fit(Manipulations::FIT_CROP, 1425, 800)
            ->format('webp')
            ->withResponsiveImages();
    }

    /**
     * Method: addHeroBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addHeroBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'hero_image_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('hero')
            ->fit(Manipulations::FIT_CROP, 2560, 720)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('hero-webp')
            ->fit(Manipulations::FIT_CROP, 2560, 720)
            ->format('webp')
            ->withResponsiveImages();
    }

    /**
     * Method: addHighlightBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addHighlightBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'highlight_image_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('highlight')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('highlight-webp')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->format('webp')
            ->withResponsiveImages();
    }

    /**
     * Method: addArticleWithMediaBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addArticleWithMediaBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'article_with_media_images_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('article-with-media')
            ->fit(Manipulations::FIT_CROP, 1240, 930)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('article-with-media-webp')
            ->fit(Manipulations::FIT_CROP, 1240, 930)
            ->format('webp')
            ->withResponsiveImages();
    }

    /**
     * Method: addImageBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addImageBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'images_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('images')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('images-webp')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->format('webp')
            ->withResponsiveImages();
    }

    /**
     * Method: addQuoteBlockConversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    protected function addQuoteBlockConversions(?Media $media = null): void
    {
        if (! $media || ! Str::startsWith($media->collection_name, 'quote_image_')) {
            return;
        }

        // Crop the image to a 9:16 ratio and add responsive images
        $this->addMediaConversion('quote')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->withResponsiveImages();

        // Add a webp variant
        $this->addMediaConversion('quote-webp')
            ->fit(Manipulations::FIT_CROP, 2560, 1440)
            ->format('webp')
            ->withResponsiveImages();
    }
}
