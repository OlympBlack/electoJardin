@extends('backend.layouts.master')

@section('main-content')
<!-- Exemple DataTables -->
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Liste des commandes</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      @if(count($orders)>0)
      <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>N°</th>
            <th>Numéro de commande</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Quantité</th>
            <th>Frais</th>
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
            <th>Frais</th>
            <th>Montant total</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($orders as $order)  
          @php
              $shipping_charge = DB::table('shippings')->where('id', $order->shipping_id)->pluck('price');
          @endphp 
          <tr>
              <td>{{$order->id}}</td>
              <td>{{$order->order_number}}</td>
              <td>{{$order->first_name}} {{$order->last_name}}</td>
              <td>{{$order->email}}</td>
              <td>{{$order->quantity}}</td>
              <td>@foreach($shipping_charge as $data) ${{ number_format($data, 2) }} @endforeach</td>
              <td>${{ number_format($order->total_amount, 2) }}</td>
              <td>
                  @if($order->payment_status == 'paid')
                    <span class="badge badge-success">Payé</span>
                  @elseif($order->payment_status == 'pending')
                    <span class="badge badge-warning">En attente</span>
                  @elseif($order->payment_status == 'unpaid')
                    <span class="badge badge-danger">Non payé</span>
                  @endif
              </td>
              <td>
                  <a href="{{ route('order.show', $order->id) }}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Voir"><i class="fas fa-eye"></i></a>
                  <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Modifier"><i class="fas fa-edit"></i></a>
                  <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                      @csrf 
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                  </form>
              </td>
          </tr>  
          @endforeach
        </tbody>
      </table>
      @else
        <h6 class="text-center">Aucune commande trouvée !!! Veuillez commander des produits</h6>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')

<!-- Plugins DataTables -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Script DataTable personnalisé -->
<script>
  $('#order-dataTable').DataTable({
    "columnDefs": [
      {
        "orderable": false,
        "targets": [8]
      }
    ],
    "language": {
      "paginate": {
        "previous": "Précédent",
        "next": "Suivant"
      },
      "lengthMenu": "Afficher _MENU_ entrées",
      "zeroRecords": "Aucun enregistrement trouvé",
      "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
      "infoEmpty": "Aucune donnée disponible",
      "infoFiltered": "(filtré depuis _MAX_ entrées totales)"
    }
  });
</script>

<!-- Script de suppression avec confirmation -->
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
          text: "Une fois supprimé, vous ne pourrez pas récupérer cette donnée !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        } else {
          swal("Votre donnée est en sécurité !");
        }
      });
    });
  });
</script>
@endpush
