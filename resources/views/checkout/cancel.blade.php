<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement annulé</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Roboto, sans-serif;
      background: #fef6f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .error-box {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 90%;
    }

    .error-box h2 {
      color: #e74c3c;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .error-box p {
      font-size: 16px;
      color: #333;
      margin-bottom: 30px;
    }

    .error-box .icon-cross {
      font-size: 60px;
      color: #e74c3c;
      margin-bottom: 20px;
    }

    .btn-retry {
      display: inline-block;
      padding: 12px 20px;
      background-color: #e74c3c;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .btn-retry:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

  <div class="error-box">
    <div class="icon-cross">❌</div>
    <h2>Paiement annulé</h2>
    <p>Votre commande n’a pas été traitée.</p>
    <a href="/" class="btn-retry">Réessayer</a>
  </div>

</body>
</html>
