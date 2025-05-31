@extends('backend.layouts.master')

@section('title','Détail de la commande')

@section('main-content')
<div class="card">
  <h5 class="card-header">Modifier la commande</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Statut :</label>
        <select name="payment_status" class="form-control">
          <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Payé</option>
          <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>En attente</option>
          <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Non payé</option>
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
