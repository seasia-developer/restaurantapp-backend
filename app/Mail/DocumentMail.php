<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;

class DocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        // return new Envelope(
        //     subject: 'Document Mail',
        // );

        return new Envelope(
            from: new Address('no-reply@wesellrestaurants.com', 'WSR'),
            subject: $this->mailData['subject_name'],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // return new Content(
        //     view: 'view.name',
        // );

        return new Content(
            view: 'emails.listingDocMail',
            with: [
                'text_body' => $this->mailData['text_body'],
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
        //return [];
        return [
            Attachment::fromPath($this->mailData['attach_file']),
        ];
    }
}
