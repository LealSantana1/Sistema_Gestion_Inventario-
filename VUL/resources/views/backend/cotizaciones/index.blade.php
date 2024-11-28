@extends('backend.layouts.master')

@section('title')
    Cotizaciones - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            margin: 0 5px;
        }
        .header-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .page-title {
            font-size: 1.75rem;
            font-weight: bold;
        }
        .breadcrumbs {
            margin-top: 10px;
        }
    </style>
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Cotizaciones</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Todos las Cotizaciones</span></li>
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
                    <h4 class="header-title float-left">Lista de Cotizaciones</h4>
                    <p class="float-right mb-3">
                        <a class="btn btn-primary text-white" href="{{ route('admin.cotizaciones.create') }}">Crear Nueva Cotización</a>
                        <a class="btn btn-success text-white" href="{{ route('admin.cotizaciones.pdf') }}"   target="_blank">Generar PDF</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-striped table-bordered text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Proveedor</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Precio Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotizaciones as $cotizacion)
                                   <tr>
                                    <td>{{ $cotizacion->id }}</td>
                                    <td>{{ $cotizacion->proveedor->nombre }}</td>
                                    <td>{{ $cotizacion->producto }}</td>
                                    <td>{{ $cotizacion->descripcion }}</td>
                                    <td>{{ $cotizacion->precio_total }}</td>
                                    <td>
                                        <a class="btn btn-info text-white" href="{{ route('admin.cotizaciones.show', $cotizacion->id) }}">Detalles</a>
                                        <a class="btn btn-success text-white" href="{{ route('admin.cotizaciones.edit', $cotizacion->id) }}">Editar</a>
                                        <form action="{{ route('admin.cotizaciones.destroy', $cotizacion->id) }}" method="POST" style="display:inline;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white" onclick="return confirm('¿Estás seguro de eliminar la cotización?')">Eliminar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
