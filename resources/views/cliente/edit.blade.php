@extends('backend.layouts.master')

@section('title')
    Editar Cliente - Panel de Administración
@endsection

@section('styles')
    <!-- Agregar estilos si es necesario -->
    <style>
        .form-control {
            display: inline-block;
            width: calc(100% - 40px);
            padding-left: 30px;
            position: relative;
        }

        .form-control i {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #ccc;
        }

        /* Centrar los botones */
        .button-group {
            display: flex;
            justify-content: center; /* Centra los botones horizontalmente */
            gap: 10px; /* Espacio entre los botones */
            margin-top: 20px; /* Añadir un pequeño margen superior */
        }

        .btn {
            font-size: 1rem;
            font-weight: 600;
        }
    </style>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Editar Cliente</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.clientes.index') }}">Clientes</a></li>
                        <li><span>Editar Cliente</span></li>
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
                        <h4 class="header-title">Editar Cliente: {{ $cliente->persona->razon_social }}</h4>

                        <!-- Formulario de edición del cliente -->
                        <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Nombre del Cliente -->
                                <div class="col-md-4 mb-3">
                                    <label for="nombre"><i class="fa fa-user"></i> Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                           value="{{ old('nombre', $cliente->persona->razon_social) }}" required>
                                </div>

                                <!-- Tipo de Documento -->
                                <div class="col-md-4 mb-3">
                                    <label for="documento_id"><i class="fa fa-id-card"></i> Tipo de Documento</label>
                                    <select name="documento_id" id="documento_id" class="form-control">
                                        <option value="">Seleccionar tipo de documento</option>
                                        @foreach($documentos as $documento)
                                            <option value="{{ $documento->id }}"
                                                {{ old('documento_id', $cliente->persona->documento_id) == $documento->id ? 'selected' : '' }}>
                                                {{ $documento->tipo_documento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Número de Documento -->
                                <div class="col-md-4 mb-3">
                                    <label for="numero_documento"><i class="fa fa-file-alt"></i> Número de Documento</label>
                                    <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                                           value="{{ old('numero_documento', $cliente->persona->numero_documento) }}" required>
                                </div>

                                <!-- Tipo de Cliente -->
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_persona"><i class="fa fa-users"></i> Tipo de Cliente</label>
                                    <select name="tipo_persona" id="tipo_persona" class="form-control">
                                        <option value="natural" {{ old('tipo_persona', $cliente->persona->tipo_persona) == 'natural' ? 'selected' : '' }}>Persona Natural</option>
                                        <option value="juridica" {{ old('tipo_persona', $cliente->persona->tipo_persona) == 'juridica' ? 'selected' : '' }}>Persona Jurídica</option>
                                    </select>
                                </div>

                                <!-- Estado del Cliente -->
                                <div class="col-md-4 mb-3">
                                    <label for="estado"><i class="fa fa-toggle-on"></i> Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="1" {{ old('estado', $cliente->persona->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('estado', $cliente->persona->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <!-- Grupo de botones centrados -->
                                    <div class="button-group">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Actualizar Cliente</button>
                                        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
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
    <!-- Agregar scripts si es necesario -->
@endsection
