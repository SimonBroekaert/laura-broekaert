<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Plan;
use App\Models\Session;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function declineSession(Request $request, Plan $plan, Session $session, Client $client)
    {
        $email = setting('contact_email', config('mail.from.address'));
        $phone = setting('contact_phone');

        if (! $request->hasValidSignature() || $session->is_declined || ! $plan->clients()->where('client_id', $client->id)->exists()) {
            return view('sessions.decline', [
                'plan' => null,
                'session' => null,
                'client' => null,
                'email' => $email,
                'phone' => $phone,
            ]);
        }

        $session->decline($client)
            ->save();

        return view('sessions.decline', [
            'plan' => $plan,
            'session' => $session,
            'client' => $client,
            'email' => $email,
            'phone' => $phone,
        ]);
    }
}
