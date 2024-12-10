@extends('backend.layouts.master')

@section('title')
    Crear Venta - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Crear Venta</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.ventas.index') }}">Ventas</a></li>
                        <li><span>Crear Venta</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Crear Venta</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.ventas.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Detalles de la venta -->
                                <div class="col-xl-8">
                                    <div class="text-white bg-primary p-1 text-center">Detalles de la venta</div>
                                    <div class="p-3 border border-3 border-primary">
                                        <div class="form-group">
                                            <label for="producto_id">Producto:</label>
                                            <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data-size="1" title="Busque un producto aquí">
                                                @foreach ($productos as $item)
                                                    <option value="{{$item->id}}-{{$item->stock}}-{{$item->precio_venta}}">{{$item->codigo.' '.$item->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Stock -->
                                        <div class="d-flex justify-content-end">
                                            <div class="col-12 col-sm-6">
                                                <div class="row">
                                                    <label for="stock" class="col-form-label col-4">Stock:</label>
                                                    <div class="col-8">
                                                        <input disabled id="stock" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Precio de venta -->
                                        <div class="col-sm-4">
                                            <label for="precio_venta" class="form-label">Precio de venta:</label>
                                            <input disabled type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                                        </div>

                                        <!-- Cantidad -->
                                        <div class="col-sm-4">
                                            <label for="cantidad" class="form-label">Cantidad:</label>
                                            <input type="number" name="cantidad" id="cantidad" class="form-control">
                                        </div>

                                        <!-- Descuento -->
                                        <div class="col-sm-4">
                                            <label for="descuento" class="form-label">Descuento:</label>
                                            <input type="number" name="descuento" id="descuento" class="form-control">
                                        </div>

                                        <div class="form-group text-end">
                                            <button type="button" id="btn_agregar" class="btn btn-info">Agregar Producto</button>
                                        </div>

                                        <!-- Tabla para Detalle de Venta -->
                                        <div class="form-group">
                                            <table id="tabla_detalle" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio de Venta</th>
                                                    <th>Descuento</th>
                                                    <th>Subtotal</th>
                                                    <th>Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="5">Sumas</th>
                                                    <th colspan="2"><span id="sumas">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5">IGV %</th>
                                                    <th colspan="2"><span id="igv">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5">Total</th>
                                                    <th colspan="2"><span id="total">0</span></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Datos Generales -->
                                <div class="col-xl-4">
                                    <div class="text-white bg-success p-1 text-center">Datos Generales</div>
                                    <div class="p-3 border border-3 border-success">
                                        <div class="form-group">
                                            <label for="cliente_id">Cliente:</label>
                                            <select class="form-control select2" name="cliente_id" id="cliente_id" required>
                                                @foreach ($clientes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="comprobante_id">Comprobante:</label>
                                            <select class="form-control select2" name="comprobante_id" id="comprobante_id" required>
                                                @foreach ($comprobantes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->tipo_comprobante }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="numero_comprobante">Número de Comprobante:</label>
                                            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha_hora">Fecha y Hora <i class="fas fa-calendar-alt"></i>:</label>
                                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control"
                                                   value="{{ old('fecha_hora') ?? \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="impuesto">Impuesto (IGV):</label>
                                            <input type="text" name="impuesto" id="impuesto" class="form-control" value="18" readonly>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Total <i class="fas fa-dollar-sign"></i>:</label>
                                            <input type="text" name="total" id="total" class="form-control" readonly>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success">Realizar Venta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let contador = 0;
            let totalVenta = 0;

            // Función para actualizar los totales
            function actualizarTotales() {
                let igv = totalVenta * 0.18;
                $('#igv').text(igv.toFixed(2));
                $('#total').text((totalVenta + igv).toFixed(2));

                // Asegurarse de que el campo total se actualice antes de enviar
                $('input[name="total"]').val((totalVenta + igv).toFixed(2));  // Actualiza el campo oculto total
            }

            // Actualizar stock y precio cuando se seleccione un producto
            $('#producto_id').change(function() {
                let producto_data = $(this).val().split('-');
                let stock = producto_data[1];
                let precio_venta = producto_data[2];

                $('#stock').val(stock);
                $('#precio_venta').val(precio_venta);
            });

            $('#btn_agregar').click(function () {
                let producto_data = $('#producto_id').val().split('-');
                let producto_id = producto_data[0];
                let stock = parseInt(producto_data[1]);
                let precio_venta = parseFloat(producto_data[2]);
                let cantidad = parseInt($('#cantidad').val());
                let descuento = parseFloat($('#descuento').val());

                if (!cantidad || cantidad <= 0 || cantidad > stock) {
                    alert('Verifica los datos ingresados.');
                    return;
                }

                let subtotal = (cantidad * precio_venta) - descuento;
                totalVenta += subtotal;

                contador++;
                $('#tabla_detalle tbody').append(`
                    <tr id="fila_${contador}">
                        <td>${contador}</td>
                        <td>
                            <input type="hidden" name="producto_id[]" value="${producto_id}">
                            ${$('#producto_id option:selected').text()}
                        </td>
                        <td>
                            <input type="hidden" name="cantidad[]" value="${cantidad}">
                            ${cantidad}
                        </td>
                        <td>
                            <input type="hidden" name="precio_venta[]" value="${precio_venta}">
                            ${precio_venta}
                        </td>
                        <td>
                            <input type="hidden" name="descuento[]" value="${descuento}">
                            ${descuento}
                        </td>
                        <td>${subtotal.toFixed(2)}</td>
                        <td><button type="button" class="btn btn-danger" onclick="eliminarProducto(${contador}, ${subtotal})">Eliminar</button></td>
                    </tr>
                `);

                actualizarTotales();
            });

            window.eliminarProducto = function (fila_id, subtotal) {
                totalVenta -= subtotal;
                $(`#fila_${fila_id}`).remove();
                actualizarTotales();
            };
        });
    </script>
@endsection
