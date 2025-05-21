@extends('backend.layouts.master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Changer le mot de passe</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 

                        {{-- Affichage des erreurs --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach 
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">Mot de passe actuel</label>
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" autocomplete="current-password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">Nouveau mot de passe</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="new-password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-md-4 col-form-label text-md-right">Confirmer le nouveau mot de passe</label>
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new-password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
