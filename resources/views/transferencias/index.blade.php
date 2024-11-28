@extends('backend.layouts.master')

@section('title')
    Transferencias - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Transferencias</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Transferencias</span></li>
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
                    <div class="col-3"></div>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.transferencias.create') }}">Crear nueva transferencia</a>
                    </p>

                    @include('backend.layouts.partials.messages')

                    <div class="data-tables">
                        <table id="data-Table" class="table table-striped table-hover table-bordered">
                            <div class="clearfix"></div>
                            <thead class="bg-primary text-white border-bottom">
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Almacén Origen</th>
                                    <th>Almacén Destino</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferencias as $transferencia)
                                    <tr>
                                        <td>{{ $transferencia->id }}</td>
                                        <td>{{ $transferencia->name ? $transferencia->producto->name : 'N/A' }}</td>
                                        <td>{{ $transferencia->almacenOrigen->nombre }}</td>
                                        <td>{{ $transferencia->almacenDestino->nombre }}</td>
                                        <td>{{ $transferencia->cantidad }}</td>
                                        <td>{{ $transferencia->fecha_transferencia }}</td>
                                        <td>
                                            
                                            <a href="{{ route('admin.transferencias.edit', $transferencia->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.transferencias.destroy', $transferencia->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta transferencia?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
