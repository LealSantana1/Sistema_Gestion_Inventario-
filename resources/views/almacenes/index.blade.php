@extends('backend.layouts.master')

@section('title', 'Almacenes - Panel de Administración')

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Almacenes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Almacenes</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>

<div class="container">
    <h1>Almacenes</h1>
    <a href="{{ route('admin.almacenes.create') }}" class="btn btn-primary">Agregar</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Usuario Asignado</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($almacenes as $almacen)
            <tr>
                <td>{{ $almacen->nombre }}</td>
                <td>{{ $almacen->ubicacion }}</td>
                <td>{{ $almacen->usuario->name ?? 'No asignado' }}</td>
                <td>
                    @if ($almacen->estado)
                    <span class="text-success">
                        <i class="fas fa-check-circle"></i> Activo
                    </span>
                    @else
                    <span class="text-danger">
                        <i class="fas fa-times-circle"></i> Inactivo
                    </span>
                    @endif
                </td>

                <td>
                    <ul>
                        @foreach ($almacen->ubicaciones as $ubicacion)
                            <li>
                                Producto: {{ $ubicacion->producto ? $ubicacion->producto->nombre : 'No asignado' }}<br>
                                Cantidad: {{ $ubicacion->cantidad }}<br>
                                Pasillo: {{ $ubicacion->pasillo }}<br>
                                Estantería: {{ $ubicacion->estanteria }}
                            </li>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <a href="{{ route('admin.almacenes.edit', $almacen) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.almacenes.destroy', $almacen) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
