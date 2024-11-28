@extends('backend.layouts.master')

@section('title')
    Categorías - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection

@section('admin-content')

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Categorías</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Categorías</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Categorías</h4>
                    <p class="float-right mb-2">
                        <button class="btn btn-primary text-white" data-toggle="modal" data-target="#categoryModal">Crear nueva Categoría</button>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="30%">Nombre</th>
                                    <th width="45%">Descripción</th>
                                    <th width="20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $categoria->name }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td>
                                        <a class="btn btn-success text-white" href="{{ route('admin.categorias.edit', $categoria->id) }}">
                                            <i class="fa-solid fa-edit fa-lg"></i>
                                        </a>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.categorias.destroy', $categoria->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $categoria->id }}').submit();">
                                            <i class="fa-solid fa-trash fa-lg"></i>
                                        </a>
                                        <form id="delete-form-{{ $categoria->id }}" action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                                <i class="fa-solid fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Categoría -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Crear Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categorias.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la categoría" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="summernote" name="descripcion" placeholder="Descripción de la categoría" required rows="3"></textarea>
                        </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>




<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,  
                focus: true,  
            });
        });
    </script>
@endsection

