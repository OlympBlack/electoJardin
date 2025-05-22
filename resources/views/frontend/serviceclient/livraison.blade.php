@extends('frontend.layouts.master')

@section('title', 'Paiement et Livraison')

@section('main-content')
<div class="container my-5">
    <h2 class="mb-4">Informations de paiement et de livraison</h2>

    <h4 class="mt-4">💳 Paiement</h4>
    <p>Le paiement est exigible immédiatement au moment de la commande, y compris pour les produits en précommande.</p>
    
    <p><strong>Nous acceptons uniquement le paiement sécurisé par carte bancaire.</strong></p>

    <p>Le paiement est traité via notre prestataire de paiement sécurisé. Toutes les informations bancaires sont cryptées selon les normes les plus strictes (protocole SSL) et ne sont jamais conservées sur nos serveurs.</p>

    <ul>
        <li>La transaction est immédiatement débitée après vérification des informations fournies par le client.</li>
        <li>En transmettant ses données bancaires, le client confirme qu’il est bien le titulaire légal de la carte utilisée.</li>
        <li>Conformément à la législation en vigueur, l’engagement de paiement par carte bancaire est irrévocable.</li>
        <li>En cas d’erreur ou d’impossibilité de débit, la commande est automatiquement annulée.</li>
    </ul>

    <h4 class="mt-5">🚚 Livraison</h4>
    <p>Les produits sont livrés à l’adresse indiquée lors de la commande, dans un délai de <strong>2 à 5 jours ouvrables</strong> après validation de celle-ci.</p>

    <ul>
        <li>Le délai de livraison indiqué ne tient pas compte du temps de préparation de la commande.</li>
        <li>Si plusieurs articles sont commandés, ils peuvent être expédiés séparément selon leur disponibilité.</li>
        <li>Une fois expédiée, la livraison prend généralement <strong>1 à 2 jours ouvrables</strong> selon la zone géographique.</li>
        <li>Un numéro de suivi vous est communiqué dès l’expédition afin de suivre l’acheminement de votre colis.</li>
    </ul>

    

    <p class="mt-3"><strong>Important :</strong> Dès la réception du colis, la responsabilité du produit (perte ou dommage) est transférée au client.</p>
</div>
@endsection
