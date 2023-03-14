<?php

namespace App\Jobs;

use App\Enums\ClientStatus;
use App\Enums\PlanStatus;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateClientStatus implements ShouldQueue
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
    public function __construct(public Client $client, public bool $afterPlanUpdate = false, public bool $afterPlanCreate = false)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->client->is_interested || $this->afterPlanCreate) {
            if ($this->client->plans()->active()->exists()) {
                $this->client->update([
                    'status' => ClientStatus::STATUS_ACTIVE,
                ]);
            }
        }

        if ($this->client->is_active) {
            if ($this->client->plans()->active()->doesntExist()) {
                /** @var \App\Enums\PlanStatus|null $planStatus */
                $planStatus = PlanStatus::tryFrom($this->client->plans()->latest()->first()?->status);

                $this->client->update([
                    'status' => $planStatus?->clientStatus() ?? ClientStatus::STATUS_INTERESTED,
                ]);
            }
        }
    }
}
