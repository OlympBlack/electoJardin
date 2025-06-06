<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation commande</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2 style="color:rgb(215, 144, 2);">Votre commande est enregistrée !</h2>

    <p>Bonjour {{ $order->first_name }} {{ $order->last_name }},</p>

    <p>Merci pour votre commande. Voici un récapitulatif :</p>

    <ul>
        <li><strong>Numéro :</strong> {{ $order->order_number }}</li>
        <li><strong>Montant total :</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} €</li>
        <li><strong>Statut :</strong> En attente de paiement</li>
    </ul>

    <h3>Instructions pour le virement bancaire</h3>
    <ul>
        <li><strong>Bénéficiaire :</strong> Electro Jardin</li>
        <!--<li><strong>Banque :</strong> Banque Populaire</li>-->
        <li><strong>IBAN :</strong> FR76 1234 5678 9012 3456 7890 123</li>
        <li><strong>BIC / SWIFT :</strong> BPCEFRPPXXX</li>
        <li><strong>Référence à indiquer :</strong> {{ $order->order_number }}</li>
    </ul>

    <p>Nous traiterons votre commande dès réception du paiement.</p>

    <p style="margin-top: 30px;">Cordialement,<br>L’équipe Electro Jardin</p>
</body>
</html>
