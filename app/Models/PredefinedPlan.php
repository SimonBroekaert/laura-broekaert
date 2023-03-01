<?php

namespace App\Models;

use App\Casts\FlexibleCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PredefinedPlan extends Model implements Sortable
{
    use HasFactory;
    use HasSlug;
    use SortableTrait;

    /**
     * Sortable config.
     *
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
        'sort_on_has_many' => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'developer_id',
        'name',
        'slug',
        'bundles',
        'description',
        'is_online',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bundles' => FlexibleCast::class,
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
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
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
}
