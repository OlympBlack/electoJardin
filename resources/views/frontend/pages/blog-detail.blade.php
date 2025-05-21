@extends('frontend.layouts.master')

@section('title','E-TECH || Page Détail du Blog')

@section('main-content')
    <!-- Fil d'Ariane -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Article de blog avec barre latérale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Fil d'Ariane -->

    <!-- Début Article de blog -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                </div>
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{$post->title}}</h2>
                                    <div class="blog-meta">
                                        <span class="author">
                                            <a href="javascript:void(0);"><i class="fa fa-user"></i>Par {{$post->author_info['name']}}</a>
                                            <a href="javascript:void(0);"><i class="fa fa-calendar"></i>{{$post->created_at->format('d M, Y')}}</a>
                                            <a href="javascript:void(0);"><i class="fa fa-comments"></i>Commentaires ({{$post->allComments->count()}})</a>
                                        </span>
                                    </div>
                                    <div class="sharethis-inline-reaction-buttons"></div>
                                    <div class="content">
                                        @if($post->quote)
                                        <blockquote><i class="fa fa-quote-left"></i> {!! ($post->quote) !!}</blockquote>
                                        @endif
                                        <p>{!! ($post->description) !!}</p>
                                    </div>
                                </div>
                                <div class="share-social">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-tags">
                                                <h4>Tags :</h4>
                                                <ul class="tag-inner">
                                                    @php
                                                        $tags=explode(',',$post->tags);
                                                    @endphp
                                                    @foreach($tags as $tag)
                                                    <li><a href="javascript:void(0);">{{$tag}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @auth
                            <div class="col-12 mt-4">
                                <div class="reply">
                                    <div class="reply-head comment-form" id="commentFormContainer">
                                        <h2 class="reply-title">Laisser un commentaire</h2>
                                        <!-- Formulaire de commentaire -->
                                        <form class="form comment_form" id="commentForm" action="{{route('post-comment.store',$post->slug)}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                {{-- 
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Votre nom<span>*</span></label>
                                                        <input type="text" name="name" placeholder="" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Votre email<span>*</span></label>
                                                        <input type="email" name="email" placeholder="" required="required">
                                                    </div>
                                                </div> 
                                                --}}
                                                <div class="col-12">
                                                    <div class="form-group comment_form_body">
                                                        <label>Votre message<span>*</span></label>
                                                        <textarea name="comment" id="comment" rows="10" placeholder=""></textarea>
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                        <input type="hidden" name="parent_id" id="parent_id" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button">
                                                        <button type="submit" class="btn">
                                                            <span class="comment_btn comment">Publier le commentaire</span>
                                                            <span class="comment_btn reply" style="display: none;">Répondre au commentaire</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Fin Formulaire de commentaire -->
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-center p-5">
                                Vous devez <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">vous connecter</a> OU <a style="color:blue" href="{{route('register.form')}}">vous inscrire</a> pour pouvoir commenter.
                            </p>
                            @endauth

                            <div class="col-12">
                                <div class="comments">
                                    <h3 class="comment-title">Commentaires ({{$post->allComments->count()}})</h3>
                                    <!-- Commentaire unique -->
                                    @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
                                    <!-- Fin Commentaire unique -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Widget de recherche -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Rechercher ici..." name="search">
                                <button class="button" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Fin Widget de recherche -->

                        <!-- Widget catégories -->
                        <div class="single-widget category">
                            <h3 class="title">Catégories du blog</h3>
                            <ul class="categor-list">
                                @foreach(Helper::postCategoryList('posts') as $cat)
                                <li><a href="#">{{$cat->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fin Widget catégories -->

                        <!-- Widget articles récents -->
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
                        <!-- Fin Widget articles récents -->

                        <!-- Widget tags -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Tags</h3>
                            <ul class="tag">
                                @foreach(Helper::postTagList('posts') as $tag)
                                    <li><a href="">{{$tag->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fin Widget tags -->

                        <!-- Widget newsletter -->
                        <div class="single-widget newsletter">
                            <h3 class="title">Newsletter</h3>
                            <div class="letter-inner">
                                <h4>Abonnez-vous et recevez les dernières nouveautés.</h4>
                                <form action="{{route('subscribe')}}" method="POST">
                                    @csrf
                                    <div class="form-inner">
                                        <input type="email" name="email" placeholder="Entrez votre email">
                                        <button type="submit" class="btn mt-2">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Fin Widget newsletter -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Article de blog -->
@endsection

@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').show();

            var comment_id = $(this).attr('data-id');
            $('#parent_id').val(comment_id);

            var element = $(this).parent().parent().parent().parent().find('#commentFormContainer');

            $(element).append($('#commentForm'));
        });

        $('.btn-reply.cancel').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').show();
            $('.comment_btn.reply').hide();

            $(this).hide();
            $('#parent_id').val('');

            var element = $(this).parent().parent().parent().parent().parent().find('#commentFormContainer');

            $(element).append($('#commentForm'));
        });

    })(jQuery);
});
</script>
@endpush
