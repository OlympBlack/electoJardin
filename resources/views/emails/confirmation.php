<h2>Merci pour votre commande !</h2>
<p>Voici les détails de votre paiement :</p>
<ul>
    <li>Email : {{ $session->customer_email }}</li>
    <li>ID de la commande : {{ $session->id }}</li>
    <li>Montant payé : {{ number_format($session->amount_total / 100, 2) }} USD</li>
</ul>
