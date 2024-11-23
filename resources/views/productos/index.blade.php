@extends('backend.layouts.master')

@section('title')
    Productos - Panel de Administración
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
                <h4 class="page-title pull-left">Productos</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Productos</span></li>
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
                        <a class="btn btn-primary text-white" href="{{ route('admin.productos.create') }}">Crear nuevo producto</a>
                    </p>
                    <form action="{{ route('admin.productos.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="categoria_id" id="categoria_id" class="form-control">
                                    <option value="">Seleccionar Categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="marca_id" id="marca_id" class="form-control">
                                    <option value="">Seleccionar Marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->name }}</option>
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
                            <div class="clearfix"></div>
                            <thead class="bg-primary text-white border-bottom">
                                <tr>
                                    <th>ID</th>
                                    <th>SKU</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->sku }}</td>
                                        <td>{{ $producto->Descripcion }}</td>
                                        <td>{{ $producto->cantidad }}</td>
                                        <td>{{ $producto->precio }}</td>
                                        <td>{{ $producto->categoria ? $producto->categoria->name : 'N/A' }}</td>
                                        <td>{{ $producto->marca ? $producto->marca->name : 'N/A' }}</td>
                                        <td>
                                            @if($producto->image && file_exists(public_path($producto->image)))
                                                <img src="{{ asset($producto->image) }}" alt="Imagen" width="150">
                                            @else
                                                <span>No disponible</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i> Ver Detalles
                                        </a>

                                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
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



