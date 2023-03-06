<?php

namespace App\Jobs;

use App\Enums\PlanStatus;
use App\Models\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePlanStatus implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Plan $plan, public bool $afterPlanUpdate = false, public bool $afterPlanCreate = false)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set plan to finished if finished session count is equal to amount of sessions
        if ($this->plan->finished_sessions_count === $this->plan->amount_of_sessions) {
            $this->plan->update([
                'status' => PlanStatus::STATUS_FINISHED,
            ]);
        }

        // Set plan to active if finished session count is not equal to amount of sessions and plan status is finished
        if ($this->plan->status === PlanStatus::STATUS_FINISHED && $this->plan->finished_sessions_count !== $this->plan->amount_of_sessions) {
            $this->plan->update([
                'status' => PlanStatus::STATUS_ACTIVE,
            ]);
        }
    }
}
