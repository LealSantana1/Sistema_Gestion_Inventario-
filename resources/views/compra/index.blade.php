@extends('backend.layouts.master')

@section('title')
    Compras - Panel de Administración
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
                    <h4 class="page-title pull-left"><i class="fas fa-boxes"></i> Compras</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><span><i class="fas fa-shopping-cart"></i> Compras</span></li>
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
                        @can('crear-compra')
                            <p class="float-right mb-2">
                                <a class="btn btn-primary text-white" href="{{ route('admin.compras.create') }}"><i class="fas fa-plus-circle"></i> Añadir nueva compra</a>
                            </p>
                        @endcan

                        <form action="{{ route('admin.compras.index') }}" method="GET" class="mb-4">
                            <div class="row">
                                <!-- Aquí puedes agregar filtros si es necesario -->
                            </div>
                        </form>

                        @include('backend.layouts.partials.messages')

                        <div class="data-tables">
                            <table id="data-Table" class="table table-striped table-hover table-bordered">
                                <thead class="bg-primary text-white border-bottom">
                                <tr>
                                    <th><i class="fas fa-file-alt"></i> Comprobante</th>
                                    <th><i class="fas fa-truck"></i> Proveedor</th>
                                    <th><i class="fas fa-calendar-alt"></i> Fecha y hora</th>
                                    <th><i class="fas fa-dollar-sign"></i> Total</th>
                                    <th><i class="fas fa-cogs"></i> Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($compras as $item)
                                    <tr>
                                        <td>
                                            <p class="fw-semibold mb-1">{{ $item->comprobante->tipo_comprobante }}</p>
                                            <p class="text-muted mb-0">{{ $item->numero_comprobante }}</p>
                                        </td>
                                        <td>
                                            @if($item->proveedor && $item->proveedor->persona)
                                                <p class="fw-semibold mb-1">{{ ucfirst($item->proveedor->persona->tipo_persona) }}</p>
                                                <p class="text-muted mb-0">{{ $item->proveedor->persona->razon_social }}</p>
                                            @else
                                                <p class="text-muted mb-0">Proveedor no disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="fw-semibold mb-1">
                                                <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y') }}
                                            </p>
                                            <p class="fw-semibold mb-0">
                                                <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($item->fecha_hora)->format('H:i') }}
                                            </p>
                                        </td>
                                        <td>{{ $item->total }}</td>
                                        <td>
                                            <!-- Botón Ver -->
                                            <a href="{{ route('admin.compras.show', $item) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-eye"></i> Ver
                                            </a>

                                            <!-- Botón Eliminar (siempre visible) -->
                                            <form action="{{ route('admin.compras.destroy', $item) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">
                                                    <i class="fa fa-trash"></i> Eliminar
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
        if ($('#data-Table').length) {
            $('#data-Table').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
