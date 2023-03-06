<?php

namespace App\Observers;

use App\Jobs\UpdatePlanStatus;
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
    }
}
