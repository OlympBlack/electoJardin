@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Modifier un utilisateur</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nom</label>
          <input id="inputTitle" type="text" name="name" placeholder="Entrez le nom" value="{{$user->name}}" class="form-control">
          @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" name="email" placeholder="Entrez l'email" value="{{$user->email}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- 
        <div class="form-group">
          <label for="inputPassword" class="col-form-label">Mot de passe</label>
          <input id="inputPassword" type="password" name="password" placeholder="Entrez le mot de passe" value="{{$user->password}}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> 
        --}}

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="input-group">
            <span class="input-group-btn">
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choisir
              </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
          </div>
          <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        @php 
        $roles = DB::table('users')->select('role')->where('id', $user->id)->get();
        @endphp

        <div class="form-group">
          <label for="role" class="col-form-label">Rôle</label>
          <select name="role" class="form-control">
            <option value="">-----Sélectionner un rôle-----</option>
            @foreach($roles as $role)
              <option value="{{$role->role}}" {{ ($role->role == 'admin') ? 'selected' : '' }}>Admin</option>
              <option value="{{$role->role}}" {{ ($role->role == 'user') ? 'selected' : '' }}>Utilisateur</option>
            @endforeach
          </select>
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Statut</label>
          <select name="status" class="form-control">
            <option value="active" {{ ($user->status == 'active') ? 'selected' : '' }}>Actif</option>
            <option value="inactive" {{ ($user->status == 'inactive') ? 'selected' : '' }}>Inactif</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <button class="btn btn-success" type="submit">Mettre à jour</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush
