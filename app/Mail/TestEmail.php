<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct($ticketData)
    {
        $this->ticket = $ticketData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Status Updated',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_updated',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
