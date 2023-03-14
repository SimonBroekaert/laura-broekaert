<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\PercentageCast;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Traits\CalculatesPrices;
use App\Models\Traits\GeneratesCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    use CalculatesPrices;
    use GeneratesCode;
    use HasFactory;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => PaymentStatus::STATUS_PENDING,
        'method' => PaymentMethod::METHOD_CASH,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => CurrencyCast::class,
        'discount_percentage' => PercentageCast::class,
        'discount_amount' => CurrencyCast::class,
        'tax_percentage' => PercentageCast::class,
        'tax_amount' => CurrencyCast::class,
        'total_price' => CurrencyCast::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'code',
        'status',
        'method',
        'price',
        'discount_percentage',
        'discount_amount',
        'tax_percentage',
        'tax_amount',
        'total_price',
    ];

    /**
     * Relation: payable
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope: cancelled.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeCancelled(Builder $query): void
    {
        $query->where('status', PaymentStatus::STATUS_CANCELLED);
    }

    /**
     * Scope: cancelled.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePaid(Builder $query): void
    {
        $query->where('status', PaymentStatus::STATUS_PAID);
    }

    /**
     * Scope: cancelled.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePending(Builder $query): void
    {
        $query->where('status', PaymentStatus::STATUS_PENDING);
    }

    /**
     * Attribute: is_cancelled.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PaymentStatus::STATUS_CANCELLED,
        );
    }

    /**
     * Attribute: is_paid.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isPaid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PaymentStatus::STATUS_PAID,
        );
    }

    /**
     * Attribute: is_pending.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isPending(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === PaymentStatus::STATUS_PENDING,
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
                $name = $this->payable->name ?? $this->payable->title;

                return 'Betaling voor: ' . $name;
            },
        );
    }
}
