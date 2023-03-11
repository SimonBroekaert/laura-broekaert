<?php

namespace App\Jobs;

use App\Mail\SessionDeclinedAdminMail;
use App\Models\Client;
use App\Models\Session;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSessionsDeclinedAdminMail implements ShouldQueue
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
    public function __construct(public Session $session, public Client $client)
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
        Mail::send(new SessionDeclinedAdminMail($this->session, $this->client));
    }
}
