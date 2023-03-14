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

class SessionDeclinedAdminMail extends Mailable
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
                    address: $from,
                    name: config('mail.from.name'),
                ),
            ],
            from: new Address(
                address: $from,
                name: config('mail.from.name'),
            ),
            replyTo: $this->session->plan->clients
                ->map(fn (Client $client) => new Address(
                    address: $client->email,
                    name: $client->full_name,
                ))
                ->toArray(),
            subject: 'Sessie op ' . formatDateTime($this->session->datetime) . ' werd geannuleerd',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.session.declined_admin',
            with: [
                'url' => config('app.url') . '/admin/resources/sessions/' . $this->session->id,
            ]
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
