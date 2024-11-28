@extends('backend.layouts.master')

@section('title', 'Ver Venta - Panel de Administración')

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left"><i class="fas fa-eye"></i> Ver Venta</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Panel de Control</a></li>
                        <li><a href="{{ route('admin.ventas.index') }}"><i class="fas fa-cash-register"></i> Ventas</a></li>
                        <li><span><i class="fas fa-search"></i> Ver Venta</span></li>
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
                        <h4 class="header-title"><i class="fas fa-info-circle"></i> Detalles de la Venta</h4>

                        <!-- Datos generales de la venta -->
                        <div class="mb-4">
                            <table class="table">
                                <tr>
                                    <th><i class="fas fa-file-alt"></i> Tipo de Comprobante:</th>
                                    <td class="transparent-border">{{ $venta->comprobante->tipo_comprobante }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> Número de Comprobante:</th>
                                    <td class="transparent-border">{{ $venta->numero_comprobante }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user"></i> Cliente:</th>
                                    <td class="transparent-border">{{ $venta->cliente->persona->nombre_completo }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-alt"></i> Fecha:</th>
                                    <td class="transparent-border">{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-clock"></i> Hora:</th>
                                    <td class="transparent-border">{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-percent"></i> Impuesto:</th>
                                    <td class="transparent-border">{{ $venta->impuesto }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tabla de productos -->
                        <h5 class="header-title"><i class="fas fa-boxes"></i> Productos de la Venta</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Producto</th>
                                    <th class="text-white">Cantidad</th>
                                    <th class="text-white">Precio de Venta</th>
                                    <th class="text-white">Descuento</th>
                                    <th class="text-white">Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($venta->productos as $item)
                                    <tr>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->pivot->cantidad }}</td>
                                        <td>{{ $item->pivot->precio_venta }}</td>
                                        <td>{{ $item->pivot->descuento }}</td>
                                        <td class="td-subtotal">{{ ($item->pivot->cantidad * $item->pivot->precio_venta) - $item->pivot->descuento }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4">Total Suma:</th>
                                    <th id="th-suma"></th>
                                </tr>
                                <tr>
                                    <th colspan="4">Impuesto:</th>
                                    <th id="th-igv"></th>
                                </tr>
                                <tr>
                                    <th colspan="4">Total:</th>
                                    <th id="th-total"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Botón para regresar a la lista -->
                        <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Regresar a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            let sum = 0;
            let igv = {{ $venta->impuesto }};

            $('.td-subtotal').each(function() {
                sum += parseFloat($(this).text());
            });

            $('#th-suma').text(sum.toFixed(2));
            $('#th-igv').text(igv.toFixed(2));
            $('#th-total').text((sum + igv).toFixed(2));
        });
    </script>
@endpush

<style>
    .transparent-border {
        border: 1px solid rgba(0, 0, 0, 0.2);
        padding: 5px;
        background-color: rgba(169, 169, 169, 0.1);
    }
</style>
s
