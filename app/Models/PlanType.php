<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PlanType extends Model implements Sortable
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
        'amount_of_persons',
        'is_online',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_of_persons' => 'integer',
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

    /**
     * Relation: location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Relation: plans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
