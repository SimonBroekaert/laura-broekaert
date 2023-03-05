<?php

namespace App\Models;

use App\Enums\SessionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => SessionStatus::STATUS_PLANNED,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'plan_id',
        'datetime',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'datetime' => 'datetime',
        'status' => SessionStatus::class,
    ];

    /**
     * Relation: plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Relation: clients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients(): Collection
    {
        return $this->plan()->clients();
    }

    /**
     * Scope: cancelled.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCancelled(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', SessionStatus::STATUS_CANCELLED);
    }

    /**
     * Scope: declined.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeclined(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', SessionStatus::STATUS_DECLINED);
    }

    /**
     * Scope: finished.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeFinished(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', SessionStatus::STATUS_FINISHED);
    }

    /**
     * Scope: planned.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePlanned(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', SessionStatus::STATUS_PLANNED);
    }

    /**
     * Attribute: is_cancelled.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === SessionStatus::STATUS_CANCELLED,
        );
    }

    /**
     * Attribute: is_declined.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isDeclined(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === SessionStatus::STATUS_DECLINED,
        );
    }

    /**
     * Attribute: is_finished.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isFinished(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === SessionStatus::STATUS_FINISHED,
        );
    }

    /**
     * Attribute: is_planned.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isPlanned(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === SessionStatus::STATUS_PLANNED,
        );
    }
}
