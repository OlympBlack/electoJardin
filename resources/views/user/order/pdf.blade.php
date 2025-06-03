<!DOCTYPE html>
<html>
<head>
  <title>Commande @if($order)- {{$order->cart_id}} @endif</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

@if($order)
<style type="text/css">
  .invoice-header {
    background: #f7f7f7;
    padding: 10px 20px 10px 20px;
    border-bottom: 1px solid gray;
  }
  .site-logo {
    margin-top: 20px;
  }
  .invoice-right-top h3 {
    padding-right: 20px;
    margin-top: 20px;
    color: green;
    font-size: 30px!important;
    font-family: serif;
  }
  .invoice-left-top {
    border-left: 4px solid green;
    padding-left: 20px;
    padding-top: 20px;
  }
  .invoice-left-top p {
    margin: 0;
    line-height: 20px;
    font-size: 16px;
    margin-bottom: 3px;
  }
  thead {
    background: green;
    color: #FFF;
  }
  .authority h5 {
    margin-top: -10px;
    color: green;
  }
  .thanks h4 {
    color: green;
    font-size: 25px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
  }
  .site-address p {
    line-height: 6px;
    font-weight: 300;
  }
  .table tfoot .empty {
    border: none;
  }
  .table-bordered {
    border: none;
  }
  .table-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
  }
  .table td, .table th {
    padding: .30rem;
  }
  
</style>

<div class="invoice-header">
  <div class="float-left site-logo">
    <img src="{{ asset('backend/img/logo.png') }}" alt="">
  </div>
  <div class="float-right site-address">
    <h4>{{ env('APP_NAME') }}</h4>
    <p>{{ env('APP_ADDRESS') }}</p>
    <p>Téléphone : <a href="tel:{{ env('APP_PHONE') }}">{{ env('APP_PHONE') }}</a></p>
    <p>Email : <a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a></p>
  </div>
  <div class="clearfix"></div>
</div>

<div class="invoice-description">
  <div class="invoice-left-top float-left">
    <h6>Facturé à</h6>
    <h3>{{ $order->first_name }} {{ $order->last_name }}</h3>
    <div class="address">
      <p><strong>Pays : </strong>{{ $order->country }}</p>
      <p><strong>Adresse : </strong>{{ $order->address1 }} {{ $order->address2 ? ' OU ' . $order->address2 : '' }}</p>
      <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
      <p><strong>Email :</strong> {{ $order->email }}</p>
    </div>
  </div>
  <div class="invoice-right-top float-right text-right">
    <h3>Facture n°{{ $order->id }}</h3>
    <p>{{ $order->created_at->format('d/m/Y') }}</p>
  </div>
  <div class="clearfix"></div>
</div>

<section class="order_details pt-3">
  <div class="table-header">
    <h5>Détails de la commande</h5>
  </div>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($order->orderItems) && $order->orderItems->count())
        @foreach($order->orderItems as $item)
          <tr>
            <td>{{ $item->product->title ?? 'Produit non trouvé' }}</td>
            <td>x{{ $item->quantity }}</td>
            <td>{{ number_format($item->price * $item->quantity, 2) }} €</td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3" class="text-center">Aucun produit trouvé pour cette commande.</td>
        </tr>
      @endif
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th class="text-right">Sous-total :</th>
        <th>{{ number_format($order->sub_total, 2) }} €</th>
      </tr>
      <tr>
        <th></th>
        <th class="text-right">Frais de livraison :</th>
        <th>{{ number_format($order->delivery_charge, 2) }} €</th>
      </tr>
      <tr>
        <th></th>
        <th class="text-right">Total :</th>
        <th>{{ number_format($order->total_amount, 2) }} €</th>
      </tr>
    </tfoot>
  </table>
</section>

<div class="thanks mt-3">
  <h4>Merci pour votre confiance !!</h4>
</div>

<div class="authority float-right mt-5">
  <p>-----------------------------------</p>
  <h5>Signature de l'autorité :</h5>
</div>

<div class="clearfix"></div>

</body>
</html>
