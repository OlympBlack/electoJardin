@extends('frontend.layouts.master')

@section('title', 'Paiement par carte bancaire')

@section('main-content')
<div class="container my-5">
    <h2>Paiement par carte bancaire uniquement</h2>
    <p>Chez <strong>Electro Jardin</strong>, nous mettons un point d'honneur à garantir des transactions simples, rapides et sécurisées.</p>

    <p>Pour cette raison, <strong>nous acceptons uniquement les paiements par carte bancaire</strong> pour toutes les commandes effectuées sur notre site.</p>

    <h5 class="mt-4">Pourquoi la carte bancaire ?</h5>
    <ul>
        <li>✔️ Paiement instantané et confirmation rapide de votre commande</li>
        <li>✔️ Transactions protégées via des protocoles de sécurité avancés</li>
        <li>✔️ Prise en charge des principales cartes : Visa, MasterCard, etc.</li>
    </ul>

    <p class="mt-4">Nous n'acceptons pas les paiements en espèces, par chèque ou par virement. Si vous avez besoin d’assistance lors du paiement, n’hésitez pas à <a href="{{ route('aide') }}">nous contacter</a>.</p>
</div>
@endsection
