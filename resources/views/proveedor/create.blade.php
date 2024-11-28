@extends('backend.layouts.master')

@section('title')
    Crear Proveedor - Panel de Administración
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title pull-left">Crear Proveedor</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.proveedores.index') }}">Proveedores</a></li>
                    <li><span>Crear Proveedor</span></li>
                </ul>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="header-title text-center">Crear Proveedor</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.proveedores.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tipo_persona">Tipo de Proveedor:</label>
                                <select class="form-control select2" name="tipo_persona" id="tipo_persona">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="natural" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona natural</option>
                                    <option value="juridica" {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                                </select>
                                @error('tipo_persona')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group" id="box-razon-social" style="display: none;">
                                <label id="label-natural" for="razon_social">Nombres y Apellidos:</label>
                                <label id="label-juridica" for="razon_social">Nombre de la Empresa:</label>
                                <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}">
                                @error('razon_social')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input required type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                                @error('direccion')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="documento_id">Tipo de Documento:</label>
                                <select class="form-control select2" name="documento_id" id="documento_id">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($documentos as $item)
                                        <option value="{{ $item->id }}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{ $item->tipo_documento }}</option>
                                    @endforeach
                                </select>
                                @error('documento_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="numero_documento">Número de Documento:</label>
                                <input required type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ old('numero_documento') }}">
                                @error('numero_documento')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">Guardar <i class="fas fa-save"></i></button>
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
        $(document).ready(function() {
            $('#tipo_persona').on('change', function() {
                let selectValue = $(this).val();
                if (selectValue == 'natural') {
                    $('#label-juridica').hide();
                    $('#label-natural').show();
                } else {
                    $('#label-natural').hide();
                    $('#label-juridica').show();
                }

                $('#box-razon-social').show();
            });

            // Inicializar Select2
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
@endsection
