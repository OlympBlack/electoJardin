<header class="header shop">
    <!-- Barre supérieure -->
    <div class="topbar bg-success">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Partie gauche haute -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ Fin partie gauche haute -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Partie droite haute -->
                    <div class="right-content">
                        <ul class="list-main">
                            <!--<li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Suivi de commande</a></li>-->
                            <!--{{-- <li><i class="ti-alarm-clock"></i> <a href="#">Offre du jour</a></li> --}}-->
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Tableau de bord</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Tableau de bord</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Déconnexion</a></li>
                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Se connecter /</a> <a href="{{route('register.form')}}">S'inscrire</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- Fin partie droite haute -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fin barre supérieure -->

    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"></a>
                    </div>
                    <!--/ Fin Logo -->

                    <!-- Formulaire de recherche -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Rechercher un produit ici..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ Fin formulaire de recherche -->
                    </div>
                    <!--/ Fin formulaire de recherche -->

                    <div class="mobile-nav"></div>
                </div>

                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <!--<select>
                                <option>Toutes catégories</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>-->
                            <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input name="search" placeholder="Rechercher un produit ici..." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-12 d-sm-block">
                    <div class="right-bar">
                        <!-- Formulaire de recherche -->
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                            @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    @endphp
                                @endforeach
                            @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                            <!-- Élément du panier -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromWishlist())}} articles</span>
                                        <a href="{{route('wishlist')}}">Voir la liste de souhaits</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Supprimer cet article"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('cart')}}" class="btn animate">Panier</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ Fin élément panier -->
                        </div>

                        <div class="sinlge-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                            <!-- Élément du panier -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} articles</span>
                                        <a href="{{route('cart')}}">Voir le panier</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Supprimer cet article"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{number_format(Helper::totalCartPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Commander</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ Fin élément panier -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Partie intérieure du header -->
    <div class="header-inner bg-success">
        <div class="container-build text-center">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Menu principal -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">    
                                    <div class="nav-inner">    
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Accueil</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Produits</a><span class="new">Nouveauté</span></li>                                                    
                                            @foreach(Helper::getAllCategory() as $cat)
                                                <li class="{{ Request::is('category/'.$cat->slug.'*') ? 'active' : '' }}">
                                                    <a href="{{ route('product-cat', $cat->slug) }}">{{ $cat->title }}</a>
                                                </li>
                                            @endforeach

                                            <!--<li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li> -->                                   
                                            <!--<li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">Qui sommes-nous</a></li>-->
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ Fin menu principal -->    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Fin partie intérieure du header -->
</header>
<style>
    .navbar-nav {
    display: flex;
    justify-content: center; /* centre horizontalement */
    width: 100%;
}

.menu-area {
    display: flex;
    justify-content: center;
}

@media (max-width: 991.98px) {
    .navbar-nav {
        justify-content: center !important;
    }
}

.topbar .list-main li,
.topbar .list-main li a {
    color: white !important;
}

</style>