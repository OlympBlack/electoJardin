@extends('user.layouts.master')

@section('main-content')
<!-- Exemple DataTables -->
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('user.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Liste des commandes</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      @if(count($orders) > 0)
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>N°</th>
            <th>Numéro de commande</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Quantité</th>
            <th>Montant total</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>N°</th>
            <th>Numéro de commande</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Quantité</th>
            <th>Montant total</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>${{number_format($order->total_amount, 2)}}</td>
            <td>
              @if($order->payment_status=='paid')
              <span class="badge badge-success">Payé</span>
              @elseif($order->payment_status=='pending')
              <span class="badge badge-warning">En attente</span>
              @elseif($order->payment_status=='unpaid')
              <span class="badge badge-danger">Non payé</span>
              @endif
            </td>
            <td>
              <a href="{{route('user.order.show', $order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="Voir" data-placement="bottom"><i class="fas fa-eye"></i></a>
              <form method="POST" action="{{route('user.order.delete', [$order->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-end">
        {!! $orders->links() !!}
      </div>
      @else
      <h6 class="text-center">Aucune commande trouvée !!! Veuillez commander des produits</h6>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e){
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      e.preventDefault();
      swal({
        title: "Êtes-vous sûr ?",
        text: "Une fois supprimées, vous ne pourrez pas récupérer ces données !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        } else {
          swal("Vos données sont en sécurité !");
        }
      });
    });
  });
</script>
@endpush
