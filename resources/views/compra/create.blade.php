@extends('backend.layouts.master')

@section('title')
    Crear Compra - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Crear Compra</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.compras.index') }}">Compras</a></li>
                        <li><span>Crear Compra</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Crear Compra</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.compras.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Detalles de la compra -->
                                <div class="col-xl-8">
                                    <div class="text-white bg-primary p-2 text-center rounded">Detalles de la compra <i class="fas fa-box-open"></i></div>
                                    <div class="p-3 border border-3 border-primary rounded">
                                        <div class="form-group">
                                            <label for="producto_id">Producto <i class="fas fa-cogs"></i>:</label>
                                            <select class="form-control select2" name="producto_id" id="producto_id" required>
                                                @foreach ($productos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->codigo . ' - ' . $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cantidad">Cantidad <i class="fas fa-cube"></i>:</label>
                                            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio_compra">Precio de Compra <i class="fas fa-dollar-sign"></i>:</label>
                                            <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.01" min="0" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio_venta">Precio de Venta <i class="fas fa-tag"></i>:</label>
                                            <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.01" min="0" required>
                                        </div>

                                        <div class="form-group text-end">
                                            <button type="button" id="btn_agregar" class="btn btn-info"><i class="fas fa-plus-circle"></i> Agregar Producto</button>
                                        </div>

                                        <!-- Tabla para Detalle de Compra -->
                                        <div class="form-group">
                                            <table id="tabla_detalle" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th># <i class="fas fa-hashtag"></i></th>
                                                    <th>Producto <i class="fas fa-cogs"></i></th>
                                                    <th>Cantidad <i class="fas fa-cube"></i></th>
                                                    <th>Precio de Compra <i class="fas fa-dollar-sign"></i></th>
                                                    <th>Precio de Venta <i class="fas fa-tag"></i></th>
                                                    <th>Subtotal <i class="fas fa-calculator"></i></th>
                                                    <th>Acción <i class="fas fa-trash-alt"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Datos Generales -->
                                <div class="col-xl-4">
                                    <div class="text-white bg-success p-2 text-center rounded">Datos Generales <i class="fas fa-info-circle"></i></div>
                                    <div class="p-3 border border-3 border-success rounded">
                                        <div class="form-group">
                                            <label for="proveedor_id">Proveedor <i class="fas fa-truck"></i>:</label>
                                            <select class="form-control select2" name="proveedor_id" id="proveedor_id" required>
                                                @foreach ($proveedores as $item)
                                                    <option value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="comprobante_id">Comprobante <i class="fas fa-file-alt"></i>:</label>
                                            <select class="form-control select2" name="comprobante_id" id="comprobante_id" required>
                                                @foreach ($comprobantes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->tipo_comprobante }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="numero_comprobante">Número de Comprobante <i class="fas fa-id-card"></i>:</label>
                                            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha">Fecha y Hora <i class="fas fa-calendar-alt"></i>:</label>
                                            <input type="datetime-local" name="fecha" id="fecha" class="form-control"
                                                   value="{{ old('fecha') ?? \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="impuesto">Impuesto (IGV) <i class="fas fa-percent"></i>:</label>
                                            <input type="number" name="impuesto" id="impuesto" class="form-control" value="18" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="total">Total <i class="fas fa-dollar-sign"></i>:</label>
                                            <input type="text" name="total" id="total" class="form-control" readonly>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Compra</button>
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
            let totalCompra = 0;

            function actualizarTotales() {
                let igv = totalCompra * 0.18;
                $('#impuesto').val(igv.toFixed(2));
                $('#total').val((totalCompra + igv).toFixed(2));
            }

            $('#btn_agregar').click(function () {
                let producto_id = $('#producto_id').val();
                let producto_texto = $('#producto_id option:selected').text();
                let cantidad = parseInt($('#cantidad').val());
                let precio_compra = parseFloat($('#precio_compra').val());
                let precio_venta = parseFloat($('#precio_venta').val());

                if (!cantidad || !precio_compra || !precio_venta || cantidad <= 0 || precio_compra <= 0 || precio_venta <= 0) {
                    alert('Verifica los datos ingresados.');
                    return;
                }

                contador++;
                let subtotal = cantidad * precio_compra;
                totalCompra += subtotal;

                $('#tabla_detalle tbody').append(`
                    <tr id="fila_${contador}">
                        <td>${contador} <i class="fas fa-edit"></i></td>
                        <td>
                            <input type="hidden" name="producto_id[]" value="${producto_id}">
                            ${producto_texto} <i class="fas fa-box"></i>
                        </td>
                        <td>
                            <input type="hidden" name="cantidad[]" value="${cantidad}">
                            ${cantidad} <i class="fas fa-cogs"></i>
                        </td>
                        <td>
                            <input type="hidden" name="precio_compra[]" value="${precio_compra}">
                            ${precio_compra} <i class="fas fa-dollar-sign"></i>
                        </td>
                        <td>
                            <input type="hidden" name="precio_venta[]" value="${precio_venta}">
                            ${precio_venta} <i class="fas fa-tag"></i>
                        </td>
                        <td>${subtotal.toFixed(2)} <i class="fas fa-calculator"></i></td>
                        <td><button type="button" class="btn btn-danger" onclick="eliminarProducto(${contador}, ${subtotal})"><i class="fas fa-trash-alt"></i> Eliminar</button></td>
                    </tr>
                `);

                actualizarTotales();
            });

            window.eliminarProducto = function (fila_id, subtotal) {
                totalCompra -= subtotal;
                $(`#fila_${fila_id}`).remove();
                actualizarTotales();
            };
        });
    </script>
@endsection
