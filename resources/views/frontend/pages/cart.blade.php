@extends('frontend.layouts.master')
@section('title','ElectroJardin')
@section('main-content')
	<!-- Fil d'Ariane -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Panier</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Fil d'Ariane -->

	<!-- Panier d'achat -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Récapitulatif du panier -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUIT</th>
								<th>NOM</th>
								<th class="text-center">PRIX</th>
								<th class="text-center">QUANTITÉ</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="{{route('cart.update')}}" method="POST">
								@csrf
								@if(Helper::getAllProductFromCart())
									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
										<tr>
											@php
											$photo=explode(',',$cart->product['photo']);
											@endphp
											<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="{{route('product-detail',$cart->product['slug'])}}" target="_blank">{{$cart->product['title']}}</a></p>
												<p class="product-des">{!!($cart['summary']) !!}</p>
											</td>
											<td class="price" data-title="Prix"><span>${{number_format($cart['price'],2)}}</span></td>
											<td class="qty" data-title="Quantité">
												<!-- Entrée quantité -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$key}}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="quant[{{$key}}]" class="input-number" data-min="1" data-max="100" value="{{$cart->quantity}}">
													<input type="hidden" name="qty_id[]" value="{{$cart->id}}">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ Fin Entrée quantité -->
											</td>
											<td class="total-amount cart_single_price" data-title="Total"><span class="money">${{$cart['amount']}}</span></td>

											<td class="action" data-title="Supprimer"><a href="{{route('cart-delete',$cart->id)}}"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<tr>
										<td colspan="6" class="text-right">
											<button class="btn float-right" type="submit">Mettre à jour</button>
										</td>
									</tr>
								@else
									<tr>
										<td class="text-center" colspan="6">
											Aucun article dans le panier. <a href="{{route('product-grids')}}" style="color:blue;">Continuer mes achats</a>
										</td>
									</tr>
								@endif
							</form>
						</tbody>
					</table>
					<!--/ Fin Récapitulatif du panier -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Montant total -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Sous-total du panier <span>${{number_format(Helper::totalCartPrice(),2)}}</span></li>

										@if(session()->has('coupon'))
											<li class="coupon_price" data-price="{{Session::get('coupon')['value']}}">Vous économisez <span>${{number_format(Session::get('coupon')['value'],2)}}</span></li>
										@endif

										@php
											$total_amount = Helper::totalCartPrice();
											if(session()->has('coupon')){
												$total_amount -= Session::get('coupon')['value'];
											}
										@endphp

										<li class="last" id="order_total_price">Vous payez <span>${{number_format($total_amount,2)}}</span></li>
									</ul>
									<div class="button5">
										<a href="{{route('checkout')}}" class="btn">Passer à la caisse</a>
										<a href="{{route('product-grids')}}" class="btn">Continuer mes achats</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ Fin Montant total -->
				</div>
			</div>
		</div>
	</div>
	<!--/ Fin Panier d'achat -->
@endsection

@push('styles')
	<style>
		li.shipping {
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li {
			margin-bottom: 0 !important;
		}
		.list li:hover {
			background: #F7941D !important;
			color: white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
@endpush
