@extends('backend.layouts.master')

@section('title', 'Ver Compra - Panel de Administración')

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left"><i class="fas fa-eye"></i> Ver Compra</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Panel de Control</a></li>
                        <li><a href="{{ route('admin.compras.index') }}"><i class="fas fa-box"></i> Compras</a></li>
                        <li><span><i class="fas fa-search"></i> Ver Compra</span></li>
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
                        <h4 class="header-title"><i class="fas fa-info-circle"></i> Detalles de la Compra</h4>

                        <!-- Datos generales de la compra -->
                        <div class="mb-4">
                            <table class="table">
                                <tr>
                                    <th><i class="fas fa-file-alt"></i> Tipo de Comprobante:</th>
                                    <td class="transparent-border">{{ $compra->comprobante->tipo_comprobante }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> Número de Comprobante:</th>
                                    <td class="transparent-border">{{ $compra->numero_comprobante }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user"></i> Proveedor:</th>
                                    <td class="transparent-border">{{ $compra->proveedor->persona->razon_social }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-alt"></i> Fecha:</th>
                                    <td class="transparent-border">{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-clock"></i> Hora:</th>
                                    <td class="transparent-border">{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-percent"></i> Impuesto:</th>
                                    <td class="transparent-border">{{ $compra->impuesto }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tabla de productos -->
                        <h5 class="header-title"><i class="fas fa-boxes"></i> Productos de la Compra</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Producto <i class="fas fa-cogs"></i></th>
                                    <th class="text-white">Cantidad <i class="fas fa-cube"></i></th>
                                    <th class="text-white">Precio de Compra <i class="fas fa-dollar-sign"></i></th>
                                    <th class="text-white">Precio de Venta <i class="fas fa-tag"></i></th>
                                    <th class="text-white">Subtotal <i class="fas fa-calculator"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($compra->productos as $item)
                                    <tr>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->pivot->cantidad }}</td>
                                        <td>{{ $item->pivot->precio_compra }}</td>
                                        <td>{{ $item->pivot->precio_venta }}</td>
                                        <td>{{ ($item->pivot->cantidad) * ($item->pivot->precio_compra) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4">Total Suma:</th>
                                    <th>{{ round($compra->productos->sum(function($producto) { return $producto->pivot->cantidad * $producto->pivot->precio_compra; }), 2) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Impuesto:</th>
                                    <th>{{ $compra->impuesto }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Total:</th>
                                    <th>{{ round($compra->productos->sum(function($producto) { return $producto->pivot->cantidad * $producto->pivot->precio_compra; }) + $compra->impuesto, 2) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Botón para regresar a la lista -->
                        <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Regresar a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        // Función para calcular los totales, impuestos y total general en la tabla
        $(document).ready(function() {
            let sum = 0;
            let igv = parseFloat($('#input-impuesto').val());

            // Calcular la suma total
            $('.td-subtotal').each(function() {
                sum += parseFloat($(this).text());
            });

            // Actualizar los totales
            $('#th-suma').text(sum.toFixed(2));
            $('#th-igv').text(igv.toFixed(2));
            $('#th-total').text((sum + igv).toFixed(2));
        });
    </script>
@endpush

<style>
    /* Estilo para el fondo transparente con un color gris suave y bordes visibles */
    .transparent-border {
        border: 1px solid rgba(0, 0, 0, 0.2); /* Borde visible ligero */
        padding: 5px;
        background-color: rgba(169, 169, 169, 0.1); /* Fondo gris transparente */
    }
</style>
