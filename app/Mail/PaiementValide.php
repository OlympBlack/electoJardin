<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaiementValide extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * En-tête du mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de paiement pour la commande #' . $this->order->order_number
        );
    }

    /**
     * Vue à afficher + variables à passer.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.paiement_valide',
            with: [
                'order' => $this->order,
            ]
        );
    }

    /**
     * Pièces jointes (aucune ici).
     */
    public function attachments(): array
    {
        return [];
    }
}
