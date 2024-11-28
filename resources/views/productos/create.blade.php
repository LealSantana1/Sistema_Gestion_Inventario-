@extends('backend.layouts.master')

@section('title')
    Crear Producto - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Crear Producto</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.productos.index') }}">Productos</a></li>
                        <li><span>Crear Producto</span></li>
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
                        <h4 class="header-title">Crear Producto</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" class="form-control" id="sku" value="{{ old('sku') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre</label> <!-- Agregado el campo Nombre -->
                                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Descripcion">Descripción</label>
                                <textarea name="Descripcion" class="form-control" id="Descripcion" rows="3" required>{{ old('Descripcion') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" id="precio" value="{{ old('precio') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Categoría</label>
                                <select name="categoria_id" class="form-control select2" id="categoria_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="marca_id">Marca</label>
                                <select name="marca_id" class="form-control select2" id="marca_id" required>
                                    <option value="">Seleccione una marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="detalles_adicionales">Detalles Adicionales</label>
                                <textarea name="detalles_adicionales" class="form-control" id="summernote" rows="3">{{ old('detalles_adicionales') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="descuento">Descuento (%)</label>
                                <input type="number" step="0.01" name="descuento" class="form-control" id="descuento" value="{{ old('descuento') }}">
                            </div>

                            <div class="form-group">
                                <label for="fecha_creacion">Fecha de Creación</label>
                                <input type="date" name="fecha_creacion" class="form-control" id="fecha_creacion" value="{{ old('fecha_creacion') }}">
                            </div>

                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
