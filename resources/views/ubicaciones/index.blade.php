@extends('backend.layouts.master')

@section('title', 'Listado de Ubicaciones de Productos')

@section('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection

@section('admin-content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="header-title text-xl font-semibold text-gray-800">Ubicaciones de Productos</h4>
                    <a href="{{ route('admin.ubicaciones.create') }}" class="btn btn-success mb-3">
                        Crear Nueva Ubicación
                    </a>
                    <div class="overflow-x-auto">
                        <table id="dataTable" class="min-w-full bg-white border border-gray-300 shadow-md table-striped">
                            <thead>
                                <tr class="text-left bg-gray-100">
                                    <th class="py-2 px-4 font-medium text-gray-600">#</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Producto</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Almacén</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Cantidad</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Pasillo</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Estantería</th>
                                    <th class="py-2 px-4 font-medium text-gray-600">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ubicaciones as $ubicacion)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->id }}</td>
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->producto->name }}</td>
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->almacen->nombre }}</td>
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->cantidad }}</td>
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->pasillo }}</td>
                                        <td class="py-2 px-4 text-gray-700">{{ $ubicacion->estanteria }}</td>
                                        <td class="py-2 px-4 text-gray-700">
                                            <a href="{{ route('admin.ubicaciones.edit', $ubicacion->id) }}" class="btn btn-warning text-white">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.ubicaciones.destroy', $ubicacion->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white">
                                                    Eliminar
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable with responsive option
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
        });
    </script>
@endsection
