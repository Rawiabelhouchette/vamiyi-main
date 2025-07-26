<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReSubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $startDate;
    public $endDate;
    public $service;


    /**
     * Create a new message instance.
     */
    public function __construct($clientName, $startDate, $endDate, $service)
    {
        $this->clientName = $clientName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->service = $service;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de réabonnement à ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription.re-subscription',
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
