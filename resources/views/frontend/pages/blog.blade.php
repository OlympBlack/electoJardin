@extends('frontend.layouts.master')

@section('title','Blog')

@section('main-content')
    <!-- Fil d’Ariane -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Blog en grille + barre latérale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Fil d’Ariane -->

    <!-- Début Blog en grille -->
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Article individuel -->
                                <div class="shop-single-blog">
                                    <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    <div class="content">
                                        <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{$post->created_at->format('d M, Y. D')}}
                                            <span class="float-right">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                 {{$post->author_info->name ?? 'Anonyme'}}
                                            </span>
                                        </p>
                                        <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                        <p>{!! html_entity_decode($post->summary) !!}</p>
                                        <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Lire la suite</a>
                                    </div>
                                </div>
                                <!-- Fin Article individuel -->
                            </div>
                        @endforeach
                        <div class="col-12">
                            <!-- Pagination -->
                            {{-- {{$posts->appends($_GET)->links()}} --}}
                            <!--/ Fin Pagination -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Widget Recherche -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Rechercher ici..." name="search">
                                <button class="button" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ Fin Widget Recherche -->
                        <!-- Widget Catégories -->
                        <div class="single-widget category">
                            <h3 class="title">Catégories d’articles</h3>
                            <ul class="categor-list">
                                @if(!empty($_GET['category']))
                                    @php
                                        $filter_cats=explode(',',$_GET['category']);
                                    @endphp
                                @endif
                            <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    @foreach(Helper::postCategoryList('posts') as $cat)
                                    <li>
                                        <a href="{{route('blog.category',$cat->slug)}}">{{$cat->title}} </a>
                                    </li>
                                    @endforeach
                                </form>

                            </ul>
                        </div>
                        <!--/ Fin Widget Catégories -->
                        <!-- Widget Articles récents -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Articles récents</h3>
                            @foreach($recent_posts as $post)
                                <!-- Article unique -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    </div>
                                    <div class="content">
                                        <h5><a href="#">{{$post->title}}</a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$post->created_at->format('d M, y')}}</li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i>
                                                {{$post->author_info->name ?? 'Anonyme'}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Fin Article unique -->
                            @endforeach
                        </div>
                        <!--/ Fin Widget Articles récents -->
                        <!-- Widget Étiquettes -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Étiquettes</h3>
                            <ul class="tag">
                                @if(!empty($_GET['tag']))
                                    @php
                                        $filter_tags=explode(',',$_GET['tag']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    @foreach(Helper::postTagList('posts') as $tag)
                                        <li>
                                            <a href="{{route('blog.tag',$tag->title)}}">{{$tag->title}} </a>
                                        </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                        <!--/ Fin Widget Étiquettes -->
                        <!-- Widget Newsletter (commenté) -->
                        <!--<div class="single-widget newsletter">
                            <h3 class="title">Newsletter</h3>
                            <div class="letter-inner">
                                <h4>Abonnez-vous et obtenez <br> les dernières mises à jour.</h4>
                                <form method="POST" action="{{route('subscribe')}}" class="form-inner">
                                    @csrf
                                    <input type="email" name="email" placeholder="Entrez votre email">
                                    <button type="submit" class="btn " style="width: 100%">Envoyer</button>
                                </form>
                            </div>
                        </div>-->
                        <!--/ Fin Widget Newsletter -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Fin Blog en grille -->
@endsection
@push('styles')
    <style>
        .pagination{
            display:inline-flex;
        }
    </style>

@endpush
