<?php

namespace App\Observers;

use App\Jobs\UpdateClientStatus;
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

        if (! $plan->isDirty('code')) {
            $plan->generateCode();
        }
    }

    /**
     * Handle the Plan "created" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function created(Plan $plan)
    {
        foreach ($plan->clients as $client) {
            UpdateClientStatus::dispatch($client);
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
        if ($plan->isDirty(['price', 'discount_percentage']) && ! $plan->isDirty(['discount_amount'])) {
            $plan->calculateDiscount();
        }

        if ($plan->isDirty(['price', 'discount_amount', 'tax_percentage']) && ! $plan->isDirty('tax_amount')) {
            $plan->calculateTaxAmount();
        }

        if ($plan->isDirty(['price', 'discount_amount', 'tax_amount']) && ! $plan->isDirty('total_price')) {
            $plan->calculateTotalPrice();
        }
    }

    /**
     * Handle the Plan "updated" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updated(Plan $plan)
    {
        if ($plan->isDirty('status')) {
            foreach ($plan->clients as $client) {
                UpdateClientStatus::dispatch($client);
            }
        }
    }
}
