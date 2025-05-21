@extends('backend.layouts.master')

@section('main-content')
<!-- Exemple de DataTable -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des catégories d'articles</h6>
        <a href="{{route('post-category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Ajouter un utilisateur">
            <i class="fas fa-plus"></i> Ajouter une catégorie d'article
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($postCategories)>0)
            <table class="table table-bordered" id="post-category-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Slug</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Slug</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($postCategories as $data)   
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{$data->slug}}</td>
                        <td>
                            @if($data->status=='active')
                            <span class="badge badge-success">{{$data->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$data->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('post-category.edit',$data->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Modifier" data-placement="bottom">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{route('post-category.destroy',[$data->id])}}">
                                @csrf 
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$data->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$postCategories->links()}}</span>
            @else
            <h6 class="text-center">Aucune catégorie d'article trouvée ! Veuillez en créer une.</h6>
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
</style>
@endpush

@push('scripts')
<!-- Plugins de niveau page -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Scripts personnalisés de niveau page -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
    $('#post-category-dataTable').DataTable({
        "columnDefs": [
            {
                "orderable": false,
                "targets": [3, 4]
            }
        ]
    });

    // SweetAlert pour la suppression
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
                title: "Es-tu sûr ?",
                text: "Une fois supprimée, cette donnée ne pourra pas être récupérée !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Tes données sont en sécurité !");
                    }
                });
        });
    });
</script>
@endpush
