@extends('backend.layouts.master')

@section('title')
    Crear Producto - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Crear Producto</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" class="form-control" id="sku" value="{{ old('sku') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Descripcion">Descripción</label>
                                        <textarea name="Descripcion" class="form-control" id="Descripcion" rows="3" required>{{ old('Descripcion') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock') }}" required>
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
                                </div>

                                <div class="col-md-6">
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
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">Crear Producto</button>
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
