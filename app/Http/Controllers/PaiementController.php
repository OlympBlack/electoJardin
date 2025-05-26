<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use PDF;
use Illuminate\Support\Facades\Mail;

class PaiementController extends Controller
{
    public function show()
    {
        return view('paiement'); // Vue formulaire Stripe
    }

    public function paiement(Request $request)
    {
        // 1. Clé secrète Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // 2. Effectuer le paiement
            $charge = Charge::create([
                "amount" => 1000, // 10€ en centimes
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Paiement Electro Jardin",
                "receipt_email" => $request->email,
            ]);

            // 3. Préparer les données
            $data = [
                'nom' => $request->name,
                'montant' => 10,
                'date' => now()->format('d/m/Y H:i'),
            ];

            // 4. Envoyer un email
            Mail::send('emails.confirmation', $data, function($message) use ($request){
                $message->to($request->email)->subject('Confirmation de paiement');
            });

            // 5. Générer et sauvegarder la facture PDF
            $pdf = PDF::loadView('facture', $data);
            $filename = 'facture_' . now()->format('Ymd_His') . '.pdf';
            $pdf->save(public_path('factures/' . $filename));

            // 6. Redirection avec succès
            return redirect()->route('paiement.show')->with('success', 'Paiement effectué avec succès !');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
