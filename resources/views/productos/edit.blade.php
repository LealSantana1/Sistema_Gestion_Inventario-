@extends('backend.layouts.master')

@section('title')
    Editar Producto - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Editar Producto</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.productos.index') }}">Productos</a></li>
                        <li><span>Editar Producto</span></li>
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
                        <h4 class="header-title">Editar Producto</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Campo SKU -->
                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" class="form-control" id="sku" value="{{ old('sku', $producto->sku) }}" required>
                            </div>

                            <!-- Campo Nombre Agregado debajo de SKU -->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Descripcion">Descripción</label>
                                <textarea name="Descripcion" class="form-control" id="Descripcion" rows="3" required>{{ old('Descripcion', $producto->Descripcion) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', $producto->stock) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" id="precio" value="{{ old('precio', $producto->precio) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Categoría</label>
                                <select name="categoria_id" class="form-control select2" id="categoria_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="marca_id">Marca</label>
                                <select name="marca_id" class="form-control select2" id="marca_id" required>
                                    <option value="">Seleccione una marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ $producto->marca_id == $marca->id ? 'selected' : '' }}>
                                            {{ $marca->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" name="image" class="form-control" id="image">
                                @if ($producto->image)
                                    <small class="form-text text-muted">
                                        Imagen actual: <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen del producto" height="50">
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $producto->slug) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="detalles_adicionales">Detalles Adicionales</label>
                                <textarea name="detalles_adicionales" class="form-control" id="detalles_adicionales" rows="3">{{ old('detalles_adicionales', $producto->detalles_adicionales) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="descuento">Descuento (%)</label>
                                <input type="number" step="0.01" name="descuento" class="form-control" id="descuento" value="{{ old('descuento', $producto->descuento) }}">
                            </div>

                            <div class="form-group">
                                <label for="fecha_creacion">Fecha de Creación</label>
                                <input type="date" name="fecha_creacion" class="form-control" id="fecha_creacion" value="{{ old('fecha_creacion', $producto->fecha_creacion) }}">
                            </div>

                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="1" {{ $producto->status == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $producto->status == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
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
