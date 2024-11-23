@extends('backend.layouts.master')

@section('title', 'Detalles del Almacén - Panel de Administración')

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Detalles del Almacén</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.almacenes.index') }}">Almacenes</a></li>
                    <li><span>Detalles</span></li>
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
                    <h4 class="header-title">Detalles del Almacén</h4>
                    <table class="table">
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $almacen->nombre }}</td>
                        </tr>
                        <tr>
                            <th>Ubicación:</th>
                            <td>{{ $almacen->ubicacion }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.almacenes.index') }}" class="btn btn-secondary">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
