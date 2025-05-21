@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Modifier une catégorie d'article</h5>
    <div class="card-body">
      <form method="post" action="{{route('post-category.update',$postCategory->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Titre</label>
          <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{$postCategory->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Statut</label>
          <select name="status" class="form-control">
            <option value="active" {{(($postCategory->status=='active') ? 'selected' : '')}}>Actif</option>
            <option value="inactive" {{(($postCategory->status=='inactive') ? 'selected' : '')}}>Inactif</option>
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
