<?php

namespace App\Observers;

use App\Models\Plan;

class PlanObserver
{
    /**
     * Handle the Plan "creating" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function creating(Plan $plan)
    {
        if (! $plan->isDirty('discount_amount')) {
            $plan->calculateDiscount();
        }

        if (! $plan->isDirty('tax_amount')) {
            $plan->calculateTaxAmount();
        }

        if (! $plan->isDirty('total_price')) {
            $plan->calculateTotalPrice();
        }
    }

    /**
     * Handle the Plan "updating" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updating(Plan $plan)
    {
        if ($plan->isDirty(['base_price', 'discount_percentage']) && ! $plan->isDirty('discount_amount')) {
            $plan->calculateDiscount();
        }

        if ($plan->isDirty(['base_price', 'discount_percentage', 'discount_amount', 'tax_percentage']) && ! $plan->isDirty('tax_amount')) {
            $plan->calculateTaxAmount();
        }

        if ($plan->isDirty(['base_price', 'discount_percentage', 'discount_amount', 'tax_percentage', 'tax_amount']) && ! $plan->isDirty('total_price')) {
            $plan->calculateTotalPrice();
        }
    }
}
