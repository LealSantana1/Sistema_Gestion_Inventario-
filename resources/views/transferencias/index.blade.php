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

    <div class="container">
        <h1>Listado de Transferencias</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Almacén Origen</th>
                    <th>Almacén Destino</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transferencias as $transferencia)
                    <tr>
                        <td>{{ $transferencia->id }}</td>
                        <td>{{ $transferencia->almacenOrigen->nombre }}</td>
                        <td>{{ $transferencia->almacenDestino->nombre }}</td>
                        <td>{{ $transferencia->producto->nombre }}</td>
                        <td>{{ $transferencia->cantidad }}</td>
                        <td>{{ $transferencia->usuario->name }}</td>
                        <td>{{ $transferencia->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ ucfirst($transferencia->estado) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
