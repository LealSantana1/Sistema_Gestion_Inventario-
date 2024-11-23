@extends('backend.layouts.master')

@section('title', 'Editar Almacén - Panel de Administración')

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Editar Almacén</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.almacenes.index') }}">Almacenes</a></li>
                    <li><span>Editar</span></li>
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
                    <h4 class="header-title">Editar Almacén</h4>
                    <form action="{{ route('admin.almacenes.update', $almacen->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre del Almacén</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $almacen->nombre) }}" required>
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $almacen->ubicacion) }}" required>
                            @error('ubicacion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Almacén</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
