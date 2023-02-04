<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\PercentageCast;
use App\Models\Traits\CalculatesPrices;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plan extends Model implements Sortable
{
    use CalculatesPrices;
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
        'description',
        'discount_percentage',
        'discount_amount',
        'base_price',
        'tax_percentage',
        'tax_amount',
        'total_price',
        'amount_of_sessions',
        'is_online',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_of_sessions' => 'integer',
        'discount_percentage' => PercentageCast::class,
        'discount_amount' => CurrencyCast::class,
        'base_price' => CurrencyCast::class,
        'tax_percentage' => PercentageCast::class,
        'tax_amount' => CurrencyCast::class,
        'total_price' => CurrencyCast::class,
        'plan_category_id' => 'integer',
        'is_online' => 'boolean',
    ];

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var array<int, string>
     */
    protected $with = [
        'type',
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
     * Relation: type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PlanType::class, 'plan_type_id');
    }

    /**
     * Attribute: full_name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->type->name} - {$this->name}",
        );
    }
}
