<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use App\Mail\InterestedAdminMail;
use App\Mail\InterestedClientMail;
use App\Models\Client;
use App\Models\ContactFormEntry;

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

    public function interestedAdminMail()
    {
        $client = Client::inRandomOrder()->first() ?? Client::factory()
            ->hasBusiness()
            ->make();

        return new InterestedAdminMail($client);
    }

    public function interestedClientMail()
    {
        $client = Client::inRandomOrder()->first() ?? Client::factory()
            ->hasBusiness()
            ->make();

        return new InterestedClientMail($client);
    }
}
