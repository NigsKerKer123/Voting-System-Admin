<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PasskeyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailMessage;
    public $passkey;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $passkey)
    {
        $this->mailMessage = $message;
        $this->passkey = $passkey;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('buksucomelec@buksu.edu.ph', 'Buksu Comelec 2024'),
            subject: 'Buksu Comelec Passkey'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'components.mailSent',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
