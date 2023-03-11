<?php

namespace App\Observers;

use App\Enums\SessionStatus;
use App\Jobs\SendSessionsDeclinedAdminMail;
use App\Jobs\SendSessionsPlannedClientMail;
use App\Jobs\UpdatePlanStatus;
use App\Models\Client;
use App\Models\Session;

class SessionObserver
{
    /**
     * Handle the Session "created" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function created(Session $session)
    {
        UpdatePlanStatus::dispatch($session->plan, afterPlanCreate: true);

        if ($session->status === SessionStatus::STATUS_PLANNED) {
            $session->plan->clients->each(fn (Client $client) => SendSessionsPlannedClientMail::dispatch($session, $client));
        }
    }

    /**
     * Handle the Session "updated" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function updated(Session $session)
    {
        if ($session->isDirty('status')) {
            UpdatePlanStatus::dispatch($session->plan, afterPlanUpdate: true);
        }

        if ($session->isDirty('status', 'client_that_declined_id') && $session->status === SessionStatus::STATUS_DECLINED) {
            SendSessionsDeclinedAdminMail::dispatch($session, $session->clientThatDeclined);
        }
    }
}
