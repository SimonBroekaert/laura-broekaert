<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CalculatesPrices
{
    /**
     * Method: calculateDiscount
     *
     * @return self
     */
    public function calculateDiscount(): self
    {
        $this->discount_amount = $this->base_price * $this->discount_percentage / 100;

        return $this;
    }

    /**
     * Method: calculateTaxAmount
     *
     * @return self
     */
    public function calculateTaxAmount(): self
    {
        $this->tax_amount = $this->price_with_discount * $this->tax_percentage / 100;

        return $this;
    }

    /**
     * Method: calculateTotalPrice
     *
     * @return self
     */
    public function calculateTotalPrice(): self
    {
        $this->total_price = $this->price_with_discount + $this->tax_amount;

        return $this;
    }

    /**
     * Attribute: price_with_discount
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function priceWithDiscount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->base_price - $this->discount_amount,
        );
    }
}
