<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use PDF;
use Carbon\Carbon;

class StripeController extends Controller
{
    /**
     * Lancer le paiement Stripe Checkout
     */
    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Exemple : récupérer montant du panier en centimes
        $panier = session()->get('panier', []);
        $total = session()->get('total_amount', 10); // total en euros
        $email = $request->email;

        // Créer la session Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Commande Electro Jardin',
                    ],
                    'unit_amount' => $total * 100, // en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
            'customer_email' => $email,
        ]);

        // Rediriger vers l'interface Stripe Checkout
        return redirect($session->url);
    }

    /**
     * Traitement après paiement réussi
     */
    public function success(Request $request)
    {
        $session_id = $request->get('session_id');
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($session_id);
        $email = $session->customer_email;
        $montant = $session->amount_total / 100;

        // Données pour la facture
        $data = [
            'nom' => explode('@', $email)[0],
            'email' => $email,
            'montant' => $montant,
           'date' => Carbon::now(),
        ];

        // Générer la facture PDF
        $pdf = PDF::loadView('facture', $data);
        $filename = 'facture_' . now()->format('Ymd_His') . '.pdf';
        $pdfPath = public_path('factures/' . $filename);
        $pdf->save($pdfPath);

        // Envoyer l'e-mail avec la facture
        Mail::send('emails.confirmation', $data, function ($message) use ($email, $pdfPath) {
            $message->to($email)
                    ->subject('Votre facture Electro Jardin')
                    ->attach($pdfPath);
        });

        // Vider le panier
        session()->forget('panier');
        session()->forget('total_amount');

        // Afficher la page de succès
        return view('checkout.success', compact('session'));
    }

    /**
     * Paiement annulé
     */
    public function cancel()
    {
        return view('checkout.cancel');
    }
}
