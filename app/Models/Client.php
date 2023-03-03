<?php

namespace App\Models;

use App\Enums\ClientStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'status',
        'client_business_id',
        'predefined_plan_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
        'status' => ClientStatus::class,
        'client_business_id' => 'integer',
        'predefined_plan_id' => 'integer',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => ClientStatus::STATUS_ACTIVE,
    ];

    /**
     * Attribute: has_business
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hasBusiness(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->business()->exists(),
        );
    }

    /**
     * Attribute: is_interested
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isInterested(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === ClientStatus::STATUS_INTERESTED,
        );
    }

    /**
     * Attribute: is_active
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === ClientStatus::STATUS_ACTIVE,
        );
    }

    /**
     * Attribute: has_finished
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hasFinished(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === ClientStatus::STATUS_FINISHED,
        );
    }

    /**
     * Attribute: has_cancelled
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hasCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === ClientStatus::STATUS_CANCELLED,
        );
    }

    /**
     * Attribute: has_quit
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hasQuit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === ClientStatus::STATUS_QUIT,
        );
    }

    /**
     * Relation: business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(ClientBusiness::class, 'client_business_id');
    }

    /**
     * Relation: predefinedPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function predefinedPlan(): BelongsTo
    {
        return $this->belongsTo(PredefinedPlan::class, 'predefined_plan_id');
    }

    /**
     * Scope: interested.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInterested(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', ClientStatus::STATUS_INTERESTED);
    }

    /**
     * Scope: active.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', ClientStatus::STATUS_ACTIVE);
    }

    /**
     * Scope: finished.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinished(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', ClientStatus::STATUS_FINISHED);
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
        return $query->{$clause}($this->getTable() . '.status', ClientStatus::STATUS_CANCELLED);
    }

    /**
     * Scope: quit.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeQuit(Builder $query, string $clause = 'where'): Builder
    {
        return $query->{$clause}($this->getTable() . '.status', ClientStatus::STATUS_QUIT);
    }
}
