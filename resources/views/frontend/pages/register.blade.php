@extends('frontend.layouts.master')

@section('title','Inscription')

@section('main-content')
	<!-- Fil d'Ariane -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">S'inscrire</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Fil d'Ariane -->
            
    <!-- Page d'inscription -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-7 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Inscription</h2>
                        <p>Veuillez vous inscrire afin de finaliser votre commande plus rapidement</p>
                        <!-- Formulaire -->
                        <form class="form" method="post" action="{{route('register.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nom<span>*</span></label>
                                        <input type="text" name="name" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="text" name="email" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mot de passe<span>*</span></label>
                                        <input type="password" name="password" required="required" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Confirmer le mot de passe<span>*</span></label>
                                        <input type="password" name="password_confirmation" required="required" value="{{old('password_confirmation')}}">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn d-flex justify-content-center gap-3 flex-wrap">
                                        <button class="btn" type="submit">S'inscrire</button>
                                        <a href="{{route('login.form')}}" class="btn">Se connecter</a>
                                        <!-- ou
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                        <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i></a>
                                        <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i></a>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Fin de la page d'inscription -->
@endsection

@push('styles')
<style>
    .shop.login .form .btn {
        margin: 0 10px;
    }

    .btn-facebook {
        background: #39579A;
    }

    .btn-facebook:hover {
        background: #073088 !important;
    }

    .btn-github {
        background: #444444;
        color: white;
    }

    .btn-github:hover {
        background: black !important;
    }

    .btn-google {
        background: #ea4335;
        color: white;
    }

    .btn-google:hover {
        background: rgb(243, 26, 26) !important;
    }

    .login-btn {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
</style>
@endpush
