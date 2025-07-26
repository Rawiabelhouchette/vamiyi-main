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

class SubscriptionInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $offerName;
    public $duration;
    public $amount;
    public $startDate;
    public $endDate;

    
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, int $offre_id, Abonnement $subscription)
    {
        $offre = OffreAbonnement::find($offre_id);

        $this->clientName = $user->nom . ' ' . $user->prenom;
        $this->offerName = $offre->libelle;
        $this->duration = $offre->duree;
        $this->amount = $offre->prix;
        $this->startDate = $subscription->date_debut;
        $this->endDate = $subscription->date_fin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification sur un abonnement à ' . config('app.name'),
            to: ['billali.sonhouin@numrod.fr'],
            cc: ['billali.sonhouin@gmail.com']
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription.information',
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
