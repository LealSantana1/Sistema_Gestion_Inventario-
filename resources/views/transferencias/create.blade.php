@extends('backend.layouts.master')

@section('title', 'Crear Transferencia - Panel de Administración')

@section('admin-content')
    <h4 class="page-title">Crear Transferencia</h4>

    <form action="{{ route('admin.transferencias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" class="form-control select2" id="producto_id" require>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                @endforeach
            </select>
        </div>
       
        <div class="form-group">
            <label for="almacen_origen_id">Almacén Origen</label>
            <select name="almacen_origen_id" id="almacen_origen_id" class="form-control">
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="almacen_destino_id">Almacén Destino</label>
            <select name="almacen_destino_id" id="almacen_destino_id" class="form-control">
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Transferir</button>
    </form>
@endsection
