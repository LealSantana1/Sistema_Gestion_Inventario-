@extends('backend.layouts.master')

@section('title')
    Editar Proveedor - Panel de Administración
@endsection

@section('styles')
    <!-- Estilos personalizados -->
    <style>
        .card-body {
            background-color: #f8f9fa;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: none;
            font-size: 1rem;  /* Aumentar tamaño de la fuente */
            color: #333;  /* Color del texto en los campos */
            padding: 10px;  /* Aumentar espacio para un mejor clic */
            background-color: #fff;  /* Asegurarse de que el fondo sea blanco */
            border: 1px solid #ccc;  /* Borde gris claro para los campos */
        }

        .form-control:focus {
            border-color: #28a745; /* Resaltar el borde con color verde cuando está activo */
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .form-control::placeholder {
            color: #6c757d; /* Color gris para los placeholders */
            font-size: 1rem;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .breadcrumb-item a {
            color: #007bff;
        }

        .breadcrumb-item span {
            color: #6c757d;
        }

        .card-body label {
            font-weight: 600;
            font-size: 1.1rem;
            color: #495057; /* Color gris oscuro para las etiquetas */
        }

        .btn {
            font-size: 1rem;  /* Asegurar que los botones también tengan un buen tamaño de fuente */
            font-weight: 600;
        }

        .col-md-4 {
            margin-bottom: 15px; /* Asegurar que haya espacio entre los campos */
        }

        .col-12.mt-4 {
            display: flex;
            justify-content: center; /* Centrar los botones */
            gap: 10px;  /* Espacio entre los botones */
        }
    </style>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Editar Proveedor</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.proveedores.index') }}">Proveedores</a></li>
                        <li><span>Editar Proveedor</span></li>
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
                        <h4 class="header-title">Editar Proveedor: {{ $proveedor->persona->razon_social }}</h4>

                        <!-- Formulario de edición del proveedor -->
                        <form action="{{ route('admin.proveedores.update', $proveedor->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Razón Social -->
                                <div class="col-md-4 mb-3">
                                    <label for="razon_social"><i class="fa fa-building"></i> Razón Social</label>
                                    <input type="text" name="razon_social" id="razon_social" class="form-control"
                                           value="{{ old('razon_social', $proveedor->persona->razon_social) }}" required>
                                </div>

                                <!-- Tipo de Documento -->
                                <div class="col-md-4 mb-3">
                                    <label for="documento_id"><i class="fa fa-id-card"></i> Tipo de Documento</label>
                                    <select name="documento_id" id="documento_id" class="form-control" required>
                                        <option value="">Seleccionar tipo de documento</option>
                                        @foreach($documentos as $documento)
                                            <option value="{{ $documento->id }}"
                                                {{ old('documento_id', $proveedor->persona->documento_id) == $documento->id ? 'selected' : '' }}>
                                                {{ $documento->tipo_documento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Número de Documento -->
                                <div class="col-md-4 mb-3">
                                    <label for="numero_documento"><i class="fa fa-file-alt"></i> Número de Documento</label>
                                    <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                                           value="{{ old('numero_documento', $proveedor->persona->numero_documento) }}" required>
                                </div>

                                <!-- Tipo de Proveedor -->
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_persona"><i class="fa fa-users"></i> Tipo de Proveedor</label>
                                    <select name="tipo_persona" id="tipo_persona" class="form-control" required>
                                        <option value="natural" {{ old('tipo_persona', $proveedor->persona->tipo_persona) == 'natural' ? 'selected' : '' }}>Persona Natural</option>
                                        <option value="juridica" {{ old('tipo_persona', $proveedor->persona->tipo_persona) == 'juridica' ? 'selected' : '' }}>Persona Jurídica</option>
                                    </select>
                                </div>

                                <!-- Estado del Proveedor -->
                                <div class="col-md-4 mb-3">
                                    <label for="estado"><i class="fa fa-toggle-on"></i> Estado</label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="1" {{ old('estado', $proveedor->persona->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('estado', $proveedor->persona->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Actualizar Proveedor</button>
                                    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
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
    <!-- Agregar scripts si es necesario -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endsection
