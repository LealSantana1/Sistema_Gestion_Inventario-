@extends('backend.layouts.master')

@section('title', 'Listado de Ubicaciones de Productos')

@section('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection

@section('admin-content')
<div class="container">
    <h1>Ubicaciones de Productos</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Almacén</th>
                <th>Pasillo</th>
                <th>Estantería</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ubicaciones as $ubicacion)
                <tr>
                    <td>{{ $ubicacion->producto->nombre }}</td>
                    <td>{{ $ubicacion->almacen->nombre }}</td>
                    <td>{{ $ubicacion->pasillo ?? 'N/A' }}</td>
                    <td>{{ $ubicacion->estanteria ?? 'N/A' }}</td>
                    <td>{{ $ubicacion->cantidad }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay ubicaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
