<?php

namespace App\Observers;

use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "creating" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function creating(Payment $payment)
    {
        if (! $payment->isDirty('discount_amount')) {
            $payment->calculateDiscount();
        }

        if (! $payment->isDirty('tax_amount')) {
            $payment->calculateTaxAmount();
        }

        if (! $payment->isDirty('total_price')) {
            $payment->calculateTotalPrice();
        }

        if (! $payment->isDirty('code')) {
            $payment->generateCode();
        }
    }

    /**
     * Handle the Payment "updating" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updating(Payment $payment)
    {
        if ($payment->isDirty(['price', 'discount_percentage']) && ! $payment->isDirty(['discount_amount'])) {
            $payment->calculateDiscount();
        }

        if ($payment->isDirty(['price', 'discount_amount', 'tax_percentage']) && ! $payment->isDirty('tax_amount')) {
            $payment->calculateTaxAmount();
        }

        if ($payment->isDirty(['price', 'discount_amount', 'tax_amount']) && ! $payment->isDirty('total_price')) {
            $payment->calculateTotalPrice();
        }
    }
}
