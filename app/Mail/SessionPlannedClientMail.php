<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Session;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SessionPlannedClientMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Session $session, public Client $client)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $from = setting('contact_email', config('mail.from.address'));

        return new Envelope(
            to: [
                new Address(
                    address: $this->client->email,
                    name: $this->client->full_name,
                ),
            ],
            from: new Address(
                address: $from,
                name: config('mail.from.name'),
            ),
            replyTo: [
                new Address(
                    address: $from,
                    name: config('mail.from.name'),
                ),
            ],
            subject: 'Laura heeft een nieuwe sessie ingepland',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $url = URL::temporarySignedRoute(
            'plans.sessions.decline',
            $this->session->datetime->subHours(48),
            [
                'plan' => $this->session->plan,
                'client' => $this->client,
                'session' => $this->session,
            ]
        );

        return new Content(
            markdown: 'emails.session.planned_client',
            with: [
                'url' => $url,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
