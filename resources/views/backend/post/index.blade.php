@extends('backend.layouts.master')

@section('main-content')
<!-- Exemple DataTables -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification') <!-- Messages de notification -->
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des articles</h6>
        <a href="{{route('post.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Ajouter un article">
            <i class="fas fa-plus"></i> Ajouter un article
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($posts)>0)
            <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Étiquette</th>
                        <th>Auteur</th>
                        <th>Photo</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Étiquette</th>
                        <th>Auteur</th>
                        <th>Photo</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($posts as $post)
                    @php 
                        $author_info = DB::table('users')->select('name')->where('id', $post->added_by)->get();
                    @endphp
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->cat_info->title}}</td>
                        <td>{{$post->tags}}</td>
                        <td>
                            @foreach($author_info as $data)
                                {{$data->name}}
                            @endforeach
                        </td>
                        <td>
                            @if($post->photo)
                                <img src="{{$post->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$post->photo}}">
                            @else
                                <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                            @endif
                        </td>
                        <td>
                            @if($post->status == 'active')
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-warning">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="Modifier" data-placement="bottom">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{route('post.destroy',[$post->id])}}">
                                @csrf 
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id="{{$post->id}}" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$posts->links()}}</span>
            @else
                <h6 class="text-center">Aucun article trouvé ! Veuillez en créer un.</h6>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
    div.dataTables_wrapper div.dataTables_paginate {
        display: none;
    }
    .zoom {
        transition: transform .2s;
    }
    .zoom:hover {
        transform: scale(5);
    }
</style>
@endpush

@push('scripts')
<!-- Plugins de la page -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Scripts personnalisés -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
    $('#product-dataTable').DataTable({
        "columnDefs": [
            {
                "orderable": false,
                "targets": [8, 9, 10]
            }
        ]
    });

    // Alerte de suppression
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();
            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimé, vous ne pourrez plus récupérer cet article !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Votre article est en sécurité !");
                }
            });
        });
    });
</script>
@endpush
