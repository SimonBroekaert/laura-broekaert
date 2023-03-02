<?php

namespace App\Mail;

use App\Models\ContactFormEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public ContactFormEntry $entry)
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
                    address: $this->entry->email,
                    name: $this->entry->full_name,
                ),
            ],
            subject: 'Contact - Nieuw bericht - ' . $this->entry->subject,
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
            markdown: 'emails.contact.admin',
            with: [
                'url' => config('app.url') . '/admin/resources/contact-form-entries/' . $this->entry->id,
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
