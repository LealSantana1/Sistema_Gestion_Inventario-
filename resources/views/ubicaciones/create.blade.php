@extends('backend.layouts.master')

@section('title', 'Crear Ubicación de Producto')

@section('admin-content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Crear Ubicación de Producto</h4>
                    <form action="{{ route('admin.ubicaciones.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="producto_id">Producto</label>
                            <select class="form-control" id="producto_id" name="producto_id" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="almacen_id">Almacén</label>
                            <select class="form-control" id="almacen_id" name="almacen_id" required>
                                <option value="">Selecciona un almacén</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required min="0">
                        </div>

                        <div class="form-group">
                            <label for="pasillo">Pasillo</label>
                            <input type="text" class="form-control" id="pasillo" name="pasillo">
                        </div>

                        <div class="form-group">
                            <label for="estanteria">Estantería</label>
                            <input type="text" class="form-control" id="estanteria" name="estanteria">
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Ubicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
