<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement confirmé</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2 style="color:rgb(215, 144, 2);">Paiement reçu avec succès !</h2>

    <p>Bonjour {{ $order->first_name }} {{ $order->last_name }},</p>

    <p>Nous avons bien reçu votre virement bancaire pour la commande <strong>#{{ $order->order_number }}</strong>.</p>

    <ul>
        <li><strong>Montant payé :</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} €</li>
        <li><strong>Statut :</strong> Paiement validé</li>
    </ul>

    <p>Votre commande est désormais en cours de traitement et sera expédiée sous peu.</p>

    <p>Merci pour votre confiance !</p>

    <p style="margin-top: 30px;">Cordialement,<br>L’équipe Electro Jardin</p>
</body>
</html>
