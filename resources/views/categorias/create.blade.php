@extends('backend.layouts.master')

@section('title')
    Crear Categoría - Panel de Administración
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Crear Categoría</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Crear Categoría</span></li>
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
                    <h4 class="header-title">Crear Nueva Categoría</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.categorias.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nombre de la categoría" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="summernote" name="descripcion" rows="3" placeholder="Nombre de la categoría" required>{{ old('descripcion') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="bu    tton" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
