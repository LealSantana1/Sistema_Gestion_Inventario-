@extends('backend.layouts.master')

@section('title')
    Proveedores - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <style>
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .table th {
            background-color: #007bff; /* Color de fondo de los encabezados */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table i {
            margin-right: 8px;
        }
    </style>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Proveedores</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Proveedores</span></li>
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
                        <p class="float-right mb-2">
                            <a class="btn btn-primary text-white" href="{{ route('admin.proveedores.create') }}">Crear nuevo proveedor</a>
                        </p>

                        <form action="{{ route('admin.proveedores.index') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="tipo_persona" id="tipo_persona" class="form-control">
                                        <option value="">Seleccionar tipo de proveedor</option>
                                        <option value="natural" {{ request('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona natural</option>
                                        <option value="juridica" {{ request('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select name="documento_id" id="documento_id" class="form-control">
                                        <option value="">Seleccionar tipo de documento</option>
                                        @foreach($documentos as $documento)
                                            <option value="{{ $documento->id }}" {{ request('documento_id') == $documento->id ? 'selected' : '' }}>{{ $documento->tipo_documento }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">Filtrar</button>
                                </div>
                            </div>
                        </form>

                        @include('backend.layouts.partials.messages')

                        <div class="data-tables">
                            <table id="data-Table" class="table table-striped table-hover table-bordered">
                                <thead class="bg-primary text-white border-bottom">
                                <tr>
                                    <th><i class="fa fa-user"></i> Nombre</th>
                                    <th><i class="fa fa-users"></i> Tipo de Persona</th>
                                    <th><i class="fa fa-id-card"></i> Documento</th>
                                    <th><i class="fa fa-map-marker-alt"></i> Dirección</th>
                                    <th><i class="fa fa-info-circle"></i> Estado</th>
                                    <th><i class="fa fa-cogs"></i> Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proveedores as $proveedor)
                                    <tr>
                                        <td>{{ $proveedor->persona->razon_social }}</td>
                                        <td>{{ ucfirst($proveedor->persona->tipo_persona) }}</td>
                                        <td>
                                            <p class="fw-semibold mb-1">{{ $proveedor->persona->documento->tipo_documento }}</p>
                                            <p class="text-muted mb-0">{{ $proveedor->persona->numero_documento }}</p>
                                        </td>
                                        <td>{{ $proveedor->persona->direccion }}</td>
                                        <td>
                                            @if($proveedor->persona->estado == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-alt"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.proveedores.destroy', $proveedor->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                                    <i class="fa fa-trash-alt"></i> Eliminar
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
