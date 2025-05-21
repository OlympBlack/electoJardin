@extends('frontend.layouts.master')
@section('title','ElectroJardin')
@section('main-content')
	<!-- Fil d’Ariane -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Favoris</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin du Fil d’Ariane -->
			
	<!-- Panier d’Achat -->
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
								<th class="text-center">TOTAL</th> 
								<th class="text-center">AJOUTER AU PANIER</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							@if(Helper::getAllProductFromWishlist())
								@foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
									<tr>
										@php 
											$photo=explode(',',$wishlist->product['photo']);
										@endphp
										<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
											<p class="product-des">{!!($wishlist['summary']) !!}</p>
										</td>
										<td class="total-amount" data-title="Total"><span>${{$wishlist['amount']}}</span></td>
										<td><a href="{{route('add-to-cart',$wishlist->product['slug'])}}" class='btn text-white'>Ajouter au panier</a></td>
										<td class="action" data-title="Remove"><a href="{{route('wishlist-delete',$wishlist->id)}}"><i class="ti-trash remove-icon"></i></a></td>
									</tr>
								@endforeach
							@else 
								<tr>
									<td class="text-center">
										Aucune liste de favoris disponible. <a href="{{route('product-grids')}}" style="color:blue;">Continuer vos achats</a>
									</td>
								</tr>
							@endif


						</tbody>
					</table>
					<!--/ Fin du récapitulatif -->
				</div>
			</div>
		</div>
	</div>
	<!--/ Fin Panier d’Achat -->
			
	<!-- Section des services boutique (commentée) -->
	<!--
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Livraison gratuite</h4>
						<p>Pour commandes de plus de 100$</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Retour gratuit</h4>
						<p>Retour sous 30 jours</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Paiement sécurisé</h4>
						<p>Paiement 100% sécurisé</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Meilleur prix</h4>
						<p>Prix garantis</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	-->
	<!-- Fin Section services boutique -->
	
	
	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Galerie produit -->
							<div class="product-gallery">
								<div class="quickview-slider-active">
									<div class="single-slider">
										<img src="images/modal1.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal2.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal3.jpg" alt="#">
									</div>
									<div class="single-slider">
										<img src="images/modal4.jpg" alt="#">
									</div>
								</div>
							</div>
							<!-- Fin galerie produit -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Robe évasée</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 avis client)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> en stock</span>
                                    </div>
                                </div>
                                <h3>29,00 $</h3>
                                <div class="quickview-peragraph">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                </div>
								<div class="size">
									<div class="row">
										<div class="col-lg-6 col-12">
											<h5 class="title">Taille</h5>
											<select>
												<option selected="selected">S</option>
												<option>M</option>
												<option>L</option>
												<option>XL</option>
											</select>
										</div>
										<div class="col-lg-6 col-12">
											<h5 class="title">Couleur</h5>
											<select>
												<option selected="selected">orange</option>
												<option>violet</option>
												<option>noir</option>
												<option>rose</option>
											</select>
										</div>
									</div>
								</div>
                                <div class="quantity">
									<!-- Sélecteur quantité -->
									<div class="input-group">
										<div class="button minus">
											<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
										<div class="button plus">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ Fin Sélecteur quantité -->
								</div>
								<div class="add-to-cart">
									<a href="#" class="btn">Ajouter au panier</a>
									<a href="#" class="btn min"><i class="ti-heart"></i></a>
									<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
								</div>
                                <div class="default-social">
									<h4 class="share-now">Partager :</h4>
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal -->
	
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
