@extends('backend.layouts.master')

@section('title', 'Editar Ubicación de Producto')

@section('admin-content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Editar Ubicación de Producto</h4>
                    <form action="{{ route('admin.ubicaciones.update', $ubicacionProducto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="producto_id">Producto</label>
                            <select class="form-control" id="producto_id" name="producto_id" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ $ubicacionProducto->producto_id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="almacen_id">Almacén</label>
                            <select class="form-control" id="almacen_id" name="almacen_id" required>
                                <option value="">Selecciona un almacén</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}" {{ $ubicacionProducto->almacen_id == $almacen->id ? 'selected' : '' }}>
                                        {{ $almacen->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required value="{{ $ubicacionProducto->cantidad }}" min="0">
                        </div>

                        <div class="form-group">
                            <label for="pasillo">Pasillo</label>
                            <input type="text" class="form-control" id="pasillo" name="pasillo" value="{{ $ubicacionProducto->pasillo }}">
                        </div>

                        <div class="form-group">
                            <label for="estanteria">Estantería</label>
                            <input type="text" class="form-control" id="estanteria" name="estanteria" value="{{ $ubicacionProducto->estanteria }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Ubicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
