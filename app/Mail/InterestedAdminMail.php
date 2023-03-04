<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterestedAdminMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Client $client)
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
                    address: $from,
                    name: config('mail.from.name'),
                ),
            ],
            from: new Address(
                address: $from,
                name: config('mail.from.name'),
            ),
            replyTo: [
                new Address(
                    address: $this->client->email,
                    name: $this->client->full_name,
                ),
            ],
            subject: 'Nieuwe persoon met interesse: ' . $this->client->full_name,
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
            markdown: 'emails.interested.admin',
            with: [
                'url' => config('app.url') . '/admin/resources/clients/' . $this->client->id,
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