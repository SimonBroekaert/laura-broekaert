<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Location extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'developer_id',
        'name',
        'slug',
        'street',
        'street_number',
        'city',
        'postal_code',
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
     * Relation: planTypes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planTypes(): HasMany
    {
        return $this->hasMany(PlanType::class);
    }

    /**
     * Attribute: address
     *
     * @return string
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (object) [
                    'street' => $this->street,
                    'street_number' => $this->street_number,
                    'postal_code' => $this->postal_code,
                    'city' => $this->city,
                    'line_1' => $this->street . ' ' . $this->street_number,
                    'line_2' => $this->postal_code . ' ' . $this->city,
                    'full' => $this->street . ' ' . $this->street_number . ', ' . $this->postal_code . ' ' . $this->city,
                ];
            },
        );
    }
}
