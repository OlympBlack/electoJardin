@extends('layouts.app')

@section('content')

<!-- Barre d'étapes de commande -->


<div class="container mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap text-center">
        <div class="step-item active">
            <div class="circle">1</div>
            <div class="label">Panier</div>
        </div>
        <div class="step-line"></div>
        <div class="step-item active">
            <div class="circle">2</div>
            <div class="label">Confirmation</div>
        </div>
        <div class="step-line"></div>
        <div class="step-item current-step">
            <div class="circle">3</div>
            <div class="label">Virement</div>
        </div>
        <div class="step-line"></div>
        <div class="step-item">
            <div class="circle">4</div>
            <div class="label">Livraison</div>
        </div>
    </div>
</div>


<!-- Contenu principal -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-5 text-center">

                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08 0l4-4a.75.75 0 1 0-1.06-1.06L7.5 9.44 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
                        </svg>
                    </div>

                    <h2 class="fw-bold text-success">Commande passée avec succès</h2>
                    <p class="lead mt-3">Merci pour votre commande chez <strong>Electro Jardin</strong>.Un mail contenant ces informations vous a été envoyé.</p>
                    <p class="mb-4">Veuillez effectuer un virement bancaire en utilisant les informations ci-dessous :</p>

                    <div class="text-start bg-light rounded p-4 mb-4">
                        <ul class="list-unstyled mb-0">
                            <li><strong>👤 Bénéficiaire :</strong> Electro Jardin</li>
                            <!--<li><strong>🏦 Banque :</strong> Banque Populaire</li>-->
                            <li><strong>💳 IBAN :</strong> <code>FR7617238000010026836080386</code></li>
                            <li><strong>🔁 BIC / SWIFT :</strong> SCSYFRP2</li>
                        </ul>
                    </div>

                    <p><strong>Montant total à payer :</strong></p>
                    <div class="alert alert-success" style="font-size: 1.4em; font-weight: bold;">
                        {{ number_format($total_amount, 2, ',', ' ') }} €
                    </div>

                    <div class="alert alert-warning text-start">
                        ⚠️ <strong>Important :</strong> N'oubliez pas d'indiquer la <strong>référence du virement</strong> lors de votre opération bancaire.
                    </div>

                    <div class="alert alert-info" style="font-size: 1.2em; font-weight: bold;">
                        <span>Référence: </span>{{ $order_number }}
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-success px-4">Retour à l'accueil</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
