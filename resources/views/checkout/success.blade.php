<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement réussi</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Roboto, sans-serif;
      background: #f5f9f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .confirmation-box {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 90%;
    }

    .confirmation-box h2 {
      color: #2ecc71;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .confirmation-box p {
      font-size: 16px;
      color: #333;
      margin-bottom: 30px;
    }

    .confirmation-box .icon-check {
      font-size: 60px;
      color: #2ecc71;
      margin-bottom: 20px;
    }

    .btn-home {
      display: inline-block;
      padding: 12px 20px;
      background-color: #2ecc71;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .btn-home:hover {
      background-color: #27ae60;
    }
  </style>
</head>
<body>

  <div class="confirmation-box">
    <div class="icon-check">✅</div>
    <h2>Paiement réussi !</h2>
    <p>Merci pour votre achat. Une facture a été envoyée à votre adresse e-mail.</p>
    <a href="/" class="btn-home">Retour à l'accueil</a>
  </div>

</body>
</html>
