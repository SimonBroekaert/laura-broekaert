<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MenuItem extends Model implements Sortable
{
    use HasFactory;
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
        'menu_id',
        'label',
        'link',
        'order',
        'is_online',
        'opens_in_new_tab',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'menu_id' => 'integer',
        'link' => 'array',
        'order' => 'integer',
        'is_online' => 'boolean',
        'opens_in_new_tab' => 'boolean',
    ];

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
     * Relation: menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Attribute: url.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => linkPicker()->route($this->link),
        );
    }

    /**
     * Attribute: target.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function target(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->opens_in_new_tab ? '_blank' : '_self',
        );
    }

    /**
     * Attribute: route_name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function routeName(): Attribute
    {
        return Attribute::make(
            get: fn () => linkPicker()->routeName($this->link),
        );
    }
}
