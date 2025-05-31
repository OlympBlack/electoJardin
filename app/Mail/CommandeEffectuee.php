<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeEffectuee extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * L’instance de commande.
     */
    public Order $order;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Définit l’en-tête du mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre commande #' . $this->order->order_number
        );
    }

    /**
     * Définit le contenu (vue Blade + variables).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.commande_effectuee',
            with: [
                'order' => $this->order,
            ]
        );
    }

    /**
     * Pièces jointes éventuelles (optionnel).
     */
    public function attachments(): array
    {
        return [];
    }
}
