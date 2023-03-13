<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\PercentageCast;
use App\Enums\PlanStatus;
use App\Models\Traits\CalculatesPrices;
use App\Models\Traits\GeneratesCode;
use App\Models\Traits\HasComments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Plan extends Model
{
    use CalculatesPrices;
    use GeneratesCode;
    use HasFactory;
    use HasComments;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => PlanStatus::STATUS_ACTIVE,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_of_persons' => 'integer',
        'amount_of_sessions' => 'integer',
        'price' => CurrencyCast::class,
        'discount_percentage' => PercentageCast::class,
        'discount_amount' => CurrencyCast::class,
        'tax_percentage' => PercentageCast::class,
        'tax_amount' => CurrencyCast::class,
        'total_price' => CurrencyCast::class,
        'location_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'code',
        'amount_of_persons',
        'amount_of_sessions',
        'status',
        'price',
        'discount_percentage',
        'discount_amount',
        'tax_percentage',
        'tax_amount',
        'total_price',
        'location_id',
        'external_location',
    ];

    /**
     * Relation: clients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)
            ->withTimestamps();
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
     * Relation: sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Relation: payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    /**
     * Attribute: address.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hasExternalLocation
                ? $this->external_location
                : $this->location?->address?->full,
        );
    }

    /**
     * Attribute: unplanned_sessions_count.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function unplannedSessionsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->amount_of_sessions - $this->planned_sessions_count,
        );
    }

    /**
     * Attribute: planned_sessions_count.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function plannedSessionsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->sessions()
                ->where(
                    fn (Builder $query) => $query
                    ->planned()
                    ->finished('orWhere')
                )
                ->count(),
        );
    }

    /**
     * Attribute: finished_sessions_count.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function finishedSessionsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->sessions()
                ->finished()
                ->count(),
        );
    }

    /**
     * Attribute: is_active.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PlanStatus::STATUS_ACTIVE,
        );
    }

    /**
     * Attribute: is_cancelled.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PlanStatus::STATUS_CANCELLED,
        );
    }

    /**
     * Attribute: is_expired.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PlanStatus::STATUS_EXPIRED,
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
            get: fn () => $this->status === PlanStatus::STATUS_FINISHED,
        );
    }

    /**
     * Attribute: is_quit.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isQuit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PlanStatus::STATUS_QUIT,
        );
    }

    /**
     * Attribute: has_external_location.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hasExternalLocation(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->external_location !== null,
        );
    }

    /**
     * Attribute: name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function () {
                $amountOfPersons = $this->amount_of_persons;
                $amountOfSessions = $this->amount_of_sessions;

                $name = $amountOfPersons === 1
                    ? '1 persoon'
                    : "{$amountOfPersons} personen";

                $name .= $amountOfSessions === 1
                    ? ' - 1 sessie'
                    : " - {$amountOfSessions} sessies";

                return $name;
            },
        );
    }

    /**
     * Scope: active.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', PlanStatus::STATUS_ACTIVE);
    }

    /**
     * Scope: cancelled.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeCancelled(Builder $query): void
    {
        $query->where('status', PlanStatus::STATUS_CANCELLED);
    }

    /**
     * Scope: expired.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeExpired(Builder $query): void
    {
        $query->where('status', PlanStatus::STATUS_EXPIRED);
    }

    /**
     * Scope: finished.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeFinished(Builder $query): void
    {
        $query->where('status', PlanStatus::STATUS_FINISHED);
    }

    /**
     * Scope: quit.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeQuit(Builder $query): void
    {
        $query->where('status', PlanStatus::STATUS_QUIT);
    }
}
