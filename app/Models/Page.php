<?php

namespace App\Models;

use App\Casts\FlexibleCast;
use App\Enums\PredefinedPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
        "seo_title",
        "seo_description",
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
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->resolveRouteBindingQuery($this, $value, $field)
            ->where('is_online', true)
            ->whereNotIn('developer_id', PredefinedPage::cases())
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
     * Scope: linkPicker.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeLinkPicker($query): Builder
    {
        return $query->whereNotIn('developer_id', PredefinedPage::cases());
    }

    /**
     * Attribute: seo
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
}
