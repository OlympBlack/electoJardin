<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        body { font-family: DejaVu Sans; }
    </style>
</head>
<body>
    <h1>Facture</h1>
    <p>Nom: {{ $nom }}</p>
    <p>Montant payé: {{ $montant }}€</p>
    <p>Date de paiement: {{ $date->format('d/m/Y') }}</p>
</body>
</html>
