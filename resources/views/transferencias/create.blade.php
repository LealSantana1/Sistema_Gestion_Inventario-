@extends('backend.layouts.master')

@section('title', 'Transferencia de Stock - Panel de Administración')

@section('admin-content')
    <div class="container">
        <h1>Crear Transferencia de Stock</h1>

        {{-- Mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups! Hubo algunos problemas con tu entrada.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario de Transferencia --}}
        <form id="form-transferencia" action="{{ route('transferencias.store') }}" method="POST">
            @csrf

            {{-- Almacén Origen --}}
            <div class="form-group">
                <label for="almacen_origen_id">Almacén Origen</label>
                <select id="almacen_origen_id" name="almacen_origen_id" class="form-control" required>
                    <option value="">Seleccionar Almacén Origen</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Almacén Destino --}}
            <div class="form-group">
                <label for="almacen_destino_id">Almacén Destino</label>
                <select id="almacen_destino_id" name="almacen_destino_id" class="form-control" required>
                    <option value="">Seleccionar Almacén Destino</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Producto --}}
            <div class="form-group">
            <select name="productos[0][id]" class="form-control producto" required>
                        <option value="">Seleccionar Producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">
                                {{ $producto->name }}
                            </option>
                        @endforeach
                    </select>

            </div>

            {{-- Cantidad --}}
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input id="cantidad" type="number" name="cantidad" class="form-control" min="1" required>
            </div>

            {{-- Botón para agregar productos --}}
            <button id="btn-agregar" type="button" class="btn btn-secondary">Agregar a la Lista</button>

            {{-- Tabla de productos añadidos --}}
            <h3>Productos en Transferencia</h3>
            <table id="tabla-productos" class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Stock Actual</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Aquí se agregarán dinámicamente las filas de los productos --}}
                </tbody>
            </table>

            {{-- Enviar Transferencia --}}
            <button type="submit" class="btn btn-primary">Realizar Transferencia</button>
        </form>
    </div>

    {{-- Scripts necesarios --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const btnAgregar = document.getElementById('btn-agregar');
                const tablaProductos = document.getElementById('tabla-productos').querySelector('tbody');
                const form = document.getElementById('form-transferencia');

                // Evento para agregar producto a la lista
                btnAgregar.addEventListener('click', () => {
                    const productoSelect = document.getElementById('producto_id');
                    const cantidadInput = document.getElementById('cantidad');

                    const productoId = productoSelect.value;
                    const productoTexto = productoSelect.options[productoSelect.selectedIndex].text;
                    const cantidad = parseInt(cantidadInput.value);

                    if (!productoId || !cantidad || cantidad <= 0) {
                        alert('Por favor selecciona un producto y una cantidad válida.');
                        return;
                    }

                    // Verificar si el producto ya está en la tabla
                    const filas = tablaProductos.querySelectorAll('tr');
                    for (let fila of filas) {
                        if (fila.dataset.productoId === productoId) {
                            alert('Este producto ya está agregado a la lista.');
                            return;
                        }
                    }

                    // Crear fila nueva
                    const fila = document.createElement('tr');
                    fila.dataset.productoId = productoId;

                    fila.innerHTML = `
                        <td>
                            <input type="hidden" name="productos[${productoId}][id]" value="${productoId}">
                            ${productoTexto}
                        </td>
                        <td>
                            <input type="hidden" name="productos[${productoId}][cantidad]" value="${cantidad}">
                            ${cantidad}
                        </td>
                        <td>Stock Actual Desconocido</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-eliminar">Eliminar</button>
                        </td>
                    `;

                    tablaProductos.appendChild(fila);

                    // Resetear campos
                    productoSelect.value = '';
                    cantidadInput.value = '';
                });

                // Evento para eliminar productos de la lista
                tablaProductos.addEventListener('click', (e) => {
                    if (e.target.classList.contains('btn-eliminar')) {
                        e.target.closest('tr').remove();
                    }
                });
            });
        </script>
    @endpush

@endsection
