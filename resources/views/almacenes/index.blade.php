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

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Almacenes</h4>
                    <a class="btn btn-primary text-white float-right" href="{{ route('admin.almacenes.create') }}">Crear Nuevo Almacén</a>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Ubicación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($almacenes as $almacen)
                               <tr>
                                    <td>{{ $almacen->id }}</td>
                                    <td>{{ $almacen->nombre }}</td>
                                    <td>{{ $almacen->ubicacion }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('admin.almacenes.show', $almacen->id) }}">Ver</a>
                                        <a class="btn btn-warning" href="{{ route('admin.almacenes.edit', $almacen->id) }}">Editar</a>
                                        <form action="{{ route('admin.almacenes.destroy', $almacen->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este almacén?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
