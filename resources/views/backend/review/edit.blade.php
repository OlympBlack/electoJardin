@extends('backend.layouts.master')

@section('title','Modification de l\'avis')

@section('main-content')
<div class="card">
  <h5 class="card-header">Modification de l'avis</h5>
  <div class="card-body">
    <form action="{{route('review.update',$review->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">Avis de :</label>
        <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
      </div>
      <div class="form-group">
        <label for="review">Avis</label>
        <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Statut :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Sélectionner le statut--</option>
          <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Actif</option>
          <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactif</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush
