<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use App\Mail\SessionDeclinedAdminMail;
use App\Mail\SessionPlannedClientMail;
use App\Models\ContactFormEntry;
use App\Models\Plan;
use App\Models\Session;
use Illuminate\Database\Eloquent\Builder;

class PreviewController extends Controller
{
    public function contactAdminMail()
    {
        $entry = ContactFormEntry::inRandomOrder()->first() ?? ContactFormEntry::factory()
            ->make();

        return new ContactAdminMail($entry);
    }

    public function contactClientMail()
    {
        $entry = ContactFormEntry::inRandomOrder()->first() ?? ContactFormEntry::factory()
            ->make();

        return new ContactClientMail($entry);
    }

    public function sessionPlannedClientMail()
    {
        $session = Session::whereHas('plan', fn (Builder $query) => $query->has('clients'))
            ->inRandomOrder()
            ->first();

        if (! $session) {
            $plan = Plan::factory()
                ->hasClients(1)
                ->hasSessions(1)
                ->create();

            $session = $plan->sessions->first();
        }

        return new SessionPlannedClientMail($session, $session->plan->clients()->first());
    }

    public function sessionDeclinedAdminMail()
    {
        $session = Session::whereHas('plan', fn (Builder $query) => $query->has('clients'))
            ->inRandomOrder()
            ->first();

        if (! $session) {
            $plan = Plan::factory()
                ->hasClients(1)
                ->hasSessions(1)
                ->create();

            $session = $plan->sessions->first();
        }

        return new SessionDeclinedAdminMail($session, $session->plan->clients()->first());
    }
}
