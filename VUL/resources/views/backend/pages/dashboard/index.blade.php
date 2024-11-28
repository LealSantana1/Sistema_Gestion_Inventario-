@extends('backend.layouts.master')

@section('title')
Dashboard - Panel de Administración
@endsection

@section('admin-content')

<!-- Page Title Area Start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left text-primary font-weight-bold">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Inicio</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- Page Title Area End -->

<div class="main-content-inner">
    <div class="row">
        <!-- Roles Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-lg rounded-lg border-0 h-100">
                <a href="{{ route('admin.roles.index') }}" class="text-white no-underline">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fa fa-users text-4xl mb-3"></i>
                        <h5 class="text-lg font-semibold">Roles</h5>
                        <h2 class="font-bold text-3xl">{{ $total_roles }}</h2>
                    </div>
                </a>
            </div>
        </div>

        <!-- Admins Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-lg rounded-lg border-0 h-100">
                <a href="{{ route('admin.admins.index') }}" class="text-white no-underline">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fa fa-user text-4xl mb-3"></i>
                        <h5 class="text-lg font-semibold">Administradores</h5>
                        <h2 class="font-bold text-3xl">{{ $total_admins }}</h2>
                    </div>
                </a>
            </div>
        </div>

        <!-- Permissions Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning shadow-lg rounded-lg border-0 h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fa fa-key text-4xl mb-3"></i>
                    <h5 class="text-lg font-semibold">Permisos</h5>
                    <h2 class="font-bold text-3xl">{{ $total_permissions }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
