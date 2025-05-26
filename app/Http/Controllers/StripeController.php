<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        // Authentifier Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Exemple : récupérer le montant total depuis la session ou calculer
        $total = session()->get('total_amount', 1000); // en centimes ($10.00)

        // Créer la session Stripe Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Commande Electro Jardin',
                    ],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
            'customer_email' => $request->email,
        ]);

        // Rediriger vers Stripe Checkout
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $session_id = $request->get('session_id');
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Optionnel : enregistrer la commande ici en base
        // $session->customer_email peut être utile

        // Envoyer l'email
        Mail::to($session->customer_email)->send(new \App\Mail\InvoiceMail($session));

        return view('checkout.success', compact('session'));
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
