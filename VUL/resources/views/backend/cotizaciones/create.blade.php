@extends('backend.layouts.master')

@section('title')
    Crear Cotización - Panel de Administración
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Crear Cotización</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Crear Cotización</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Nuevo Cotización</h4>
                    <form action="{{ route('admin.cotizaciones.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="proveedor_id">Proveedor</label>
                            <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                                <option value="">Seleccione un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" name="producto" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio_unitario">Precio Unitario</label>
                            <input type="number" name="precio_unitario" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="precio_total">Precio Total</label>
                            <input type="number" name="precio_total" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="impuesto">Impuesto</label>
                            <input type="number" name="impuesto" class="form-control" step="0.01" placeholder="Opcional">
                        </div>
                        <div class="form-group">
                            <label for="total_con_impuesto">Total con Impuesto</label>
                            <input type="number" name="total_con_impuesto" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_cotizacion">Fecha de Cotización</label>
                            <input type="date" name="fecha_cotizacion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Cotización</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
