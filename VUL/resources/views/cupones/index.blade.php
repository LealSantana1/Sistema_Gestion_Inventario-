@extends('backend.layouts.master')

@section('title')
    Cupones - Panel de Administración
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Cupones</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Cupones</span></li>
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
                    <h4 class="header-title float-left">Cupones</h4>
                    
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.cupones.create') }}">Crear Nuevo Cupón</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descuento</th>
                                    <th>Tipo</th>
                                    <th>Válido Hasta</th>
                                    <th>Límite de Uso</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($cupones as $cupon)
                               <tr>
                                    <td>{{ $cupon->id }}</td>
                                    <td>{{ $cupon->nombre }}</td>
                                    <td>{{ $cupon->descuento }}</td>
                                    <td>{{ $cupon->tipo }}</td>
                                    <td>{{ $cupon->valido_hasta }}</td>
                                    <td>{{ $cupon->limite_uso ?? 'Sin límite' }}</td>
                                    <td>{{ $cupon->activo ? 'Sí' : 'No' }}</td>
                                    <td>
                                        <a class="btn btn-success text-white btn-sm" href="{{ route('admin.cupones.edit', $cupon->id) }}">Editar</a>
                                        <form action="{{ route('admin.cupones.destroy', $cupon->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cupón?')">Eliminar</button>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dataTable = document.getElementById('dataTable');
            if (dataTable) {
                $(dataTable).DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                    }
                });
            }
        });
    </script>
@endsection
