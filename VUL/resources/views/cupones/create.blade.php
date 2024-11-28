@extends('backend.layouts.master')

@section('title', 'Crear Cupón')

@section('admin-content')
    <h4 class="page-title">Crear Nuevo Cupón</h4>

    <form action="{{ route('admin.cupones.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del Cupón</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" name="descuento" class="form-control" value="{{ old('descuento') }}" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Descuento</label>
            <select name="tipo" class="form-control" required>
                <option value="porcentaje" {{ old('tipo') == 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
                <option value="fijo" {{ old('tipo') == 'fijo' ? 'selected' : '' }}>Fijo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="valido_hasta">Válido Hasta</label>
            <input type="date" name="valido_hasta" class="form-control" value="{{ old('valido_hasta') }}" required>
        </div>

        <div class="form-group">
            <label for="limite_uso">Límite de Uso</label>
            <input type="number" name="limite_uso" class="form-control" value="{{ old('limite_uso') }}">
        </div>

        <div class="form-group">
            <label for="activo">Activo</label>
            <input type="checkbox" name="activo" value="1" {{ old('activo') ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
