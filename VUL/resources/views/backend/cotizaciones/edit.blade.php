@extends('backend.layouts.master')

@section('title')
    Editar Cotización - Panel de Administración
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Editar Cotización</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Editar Cotización</span></li>
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
                    <form action="{{ route('admin.cotizaciones.update', $cotizacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="proveedor_id">Proveedor</label>
                            <select name="proveedor_id" class="form-control" required>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ $cotizacion->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" name="producto" class="form-control" value="{{ $cotizacion->producto }}" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control" required>{{ $cotizacion->descripcion }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio_unitario">Precio Unitario</label>
                            <input type="number" step="0.01" name="precio_unitario" class="form-control" value="{{ $cotizacion->precio_unitario }}" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" value="{{ $cotizacion->cantidad }}" required>
                        </div>
                        <div class="form-group">
                            <label for="precio_total">Precio Total</label>
                            <input type="number" step="0.01" name="precio_total" class="form-control" value="{{ $cotizacion->precio_total }}" required>
                        </div>
                        <div class="form-group">
                            <label for="impuesto">Impuesto</label>
                            <input type="number" step="0.01" name="impuesto" class="form-control" value="{{ $cotizacion->impuesto }}">
                        </div>
                        <div class="form-group">
                            <label for="total_con_impuesto">Total con Impuesto</label>
                            <input type="number" step="0.01" name="total_con_impuesto" class="form-control" value="{{ $cotizacion->total_con_impuesto }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_cotizacion">Fecha de Cotización</label>
                            <input type="date" name="fecha_cotizacion" class="form-control" value="{{ $cotizacion->fecha_cotizacion }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Cotización</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
