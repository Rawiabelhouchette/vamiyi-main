<?php

namespace App\Mail;

use App\Models\Abonnement;
use App\Models\OffreAbonnement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $username;
    public $email;

    
    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->firstName = $user->prenom;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ' Inscription réussie',
            to: [$this->email],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register.confirmation',
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
