@extends('frontend.layouts.master')

@section('title','Connexion')

@section('main-content')
    <!-- Fil d'Ariane -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Se connecter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Fil d'Ariane -->

    <!-- Connexion boutique -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-7 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Connexion</h2>
                        <p>Veuillez vous connecter afin de finaliser votre commande plus rapidement</p>
                        <!-- Formulaire -->
                        <form class="form" method="post" action="{{route('login.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mail<span>*</span></label>
                                        <input type="email" name="email" placeholder="" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mot de passe<span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group login-btn d-flex justify-content-center gap-3 flex-wrap">
                                        <button class="btn" type="submit">Se connecter</button>
                                        <a href="{{route('register.form')}}" class="btn">S'inscrire</a>
                                    </div>  
                                    
                                    <div class="checkbox text-center mt-2">
                                        <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Se souvenir de moi</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="text-center mt-2">
                                            <a class="lost-pass" href="{{ route('password.request') }}">
                                                Mot de passe oublié ?
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <!--/ Fin formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Fin Connexion -->
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
