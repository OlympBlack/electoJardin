@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">
    @include('user.layouts.notification')

    <!-- En-tête de la page -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
    </div>

    <!-- Section Commentée : Statistiques (Catégories, Produits, Commandes, Articles) -->
    {{-- 
    <div class="row">

      <!-- Catégorie -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Catégories</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::countActiveCategory()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Produits -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Produits</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::countActiveProduct()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Commandes -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Commandes</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countActiveOrder()}}</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Articles -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Articles</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Post::countActivePost()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-folder fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    --}}

    <!-- Ligne de contenu -->
    <div class="row">
      @php
          $orders = DB::table('orders')->where('user_id', auth()->user()->id)->paginate(10);
      @endphp

      <!-- Commandes de l'utilisateur -->
      <div class="col-xl-12 col-lg-12">
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
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
            @if(count($orders) > 0)
              @foreach($orders as $order)   
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{number_format($order->total_amount, 2)}}</td>
                    <td>
                        @if($order->status == 'new')
                          <span class="badge badge-primary">Nouveau</span>
                        @elseif($order->status == 'process')
                          <span class="badge badge-warning">En cours</span>
                        @elseif($order->status == 'delivered')
                          <span class="badge badge-success">Livré</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user.order.show', $order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Voir" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="{{route('user.order.delete', [$order->id])}}">
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
              @endforeach
            @else
              <td colspan="8" class="text-center"><h4 class="my-4">Vous n'avez encore aucune commande !! Veuillez commander des produits</h4></td>
            @endif
          </tbody>
        </table>

        {{$orders->links()}}
      </div>
    </div>
</div>
@endsection
