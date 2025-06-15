@extends('frontend.layouts.master')

@section('title', 'Aide et support')

@section('main-content')
<div class="container my-5">
    <section class="mb-5">
        <h2>Aide et support</h2>
        <p>Bienvenue sur la page d’aide d’<strong>Electro Jardin</strong>, votre partenaire spécialisé dans la vente de machines agricoles et horticoles (robots tondeuses, matériels de jardin et pelouse).</p>
        <p>Nous avons regroupé ici les questions les plus fréquentes et les informations utiles pour vous aider à utiliser notre site et nos services.</p>
    </section>

    <section class="mb-5">
        <h3>1. Passer une commande</h3>
        <p>Pour commander un produit :</p>
        <ul>
            <li>Parcourez notre catalogue depuis la page d’accueil.</li>
            <li>Ajoutez le produit souhaité au panier.</li>
            <li>Accédez à votre panier et suivez les étapes de validation de commande.</li>
        </ul>
    </section>

    <section class="mb-5">
    <h3>2. Modes de paiement</h3>
    <p>Actuellement, nous acceptons uniquement le virement bancaire comme moyen de paiement sécurisé :</p>
    </section>


    <section class="mb-5">
        <h3>3. Suivi de commande</h3>
        <p>Une fois votre commande passée, vous recevrez un e-mail de confirmation avec un numéro de suivi. Vous pouvez suivre votre commande en vous connectant à votre compte client.</p>
    </section>

    <section class="mb-5">
        <h3>4. Politique de retour</h3>
        <p>Si un produit ne vous convient pas, vous disposez d’un délai de 14 jours à compter de la réception pour nous le retourner dans son état d’origine. Pour en savoir plus, consultez notre page <a href="{{ route('condition') }}">Conditions d’utilisation</a>.</p>
    </section>

    <section class="mb-5">
        <h3>5. Besoin d’aide ?</h3>
        <p>Notre service client est à votre disposition :</p>
        <ul>
            <li><strong>Email :</strong> support@electrojardin.com</li>
            <li><strong>Téléphone :</strong> +33 1 23 45 67 89</li>
            <li><strong>Horaires :</strong> Lundi à Vendredi, de 9h à 18h</li>
        </ul>
        <p>Vous pouvez aussi nous contacter via le formulaire de contact disponible sur notre page <a href="{{ route('contact') }}">Contact</a>.</p>
    </section>

    <section class="mb-5">
        <h3>6. Garantie et SAV</h3>
        <p>Tous nos produits sont garantis. Pour toute demande de réparation ou de service après-vente, merci de nous contacter avec votre numéro de commande et une description du problème.</p>
    </section>
</div>
@endsection
