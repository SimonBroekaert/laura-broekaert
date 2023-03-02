<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use App\Models\ContactFormEntry;

class PreviewController extends Controller
{
    public function contactAdminMail()
    {
        $entry = ContactFormEntry::factory()
            ->make();

        return new ContactAdminMail($entry);
    }

    public function contactClientMail()
    {
        $entry = ContactFormEntry::factory()
            ->make();

        return new ContactClientMail($entry);
    }
}
