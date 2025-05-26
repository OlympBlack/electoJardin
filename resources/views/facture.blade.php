<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture - Electro Jardin</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 40px;
            line-height: 1.6;
        }

        .facture-container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #28a745;
            margin-bottom: 30px;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            font-size: 16px;
            margin: 8px 0;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #666;
        }

        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="facture-container">
        <h1>Facture</h1>

        <div class="details">
            <p><span class="highlight">Nom du client :</span> {{ $nom }}</p>
            <p><span class="highlight">Adresse e-mail :</span> {{ $email ?? 'Non précisée' }}</p>
            <p><span class="highlight">Montant payé :</span> {{ number_format($montant, 2, ',', ' ') }} €</p>
            <p><span class="highlight">Date de paiement :</span> {{ \Carbon\Carbon::parse($date)->format('d/m/Y H:i') }}</p>
        </div>

        <div class="footer">
            Merci pour votre confiance.<br>
            Electro Jardin - Votre partenaire en équipements agricoles et horticoles.
        </div>
    </div>
</body>
</html>
