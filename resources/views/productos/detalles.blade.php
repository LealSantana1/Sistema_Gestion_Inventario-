@extends('backend.layouts.master')

@section('title')
    Detalles del Producto - Panel de Administración
@endsection

@section('admin-content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Detalles del Producto</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.productos.index') }}">Productos</a></li>
                        <li><span>Detalles del Producto</span></li>
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
                        <h4 class="header-title">Detalles del Producto</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>SKU:</strong> {{ $producto->sku }}</p>
                                <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                <p><strong>Descripción:</strong> {{ $producto->Descripcion }}</p>
                                <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                                <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                                <p><strong>Marca:</strong> {{ $producto->marca->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Estado:</strong>
                                    @if($producto->status == 1)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </p>
                                <p><strong>Descuento:</strong> {{ $producto->descuento ?? 0 }}%</p>
                                <p><strong>Slug:</strong> {{ $producto->slug }}</p>
                                <p><strong>Detalles Adicionales:</strong></p>
                                <p>{{ $producto->detalles_adicionales }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <td>
                                    @if($producto->image && file_exists(public_path($producto->image)))
                                        <img src="{{ asset($producto->image) }}" alt="Imagen" width="150">
                                    @else
                                        <span>No disponible</span>
                                    @endif
                                </td>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Volver a la Lista</a>
                                <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-primary">Editar Producto</a>
                                <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar Producto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
