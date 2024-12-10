 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">INVENTARIO</h2>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('productos.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Gestion de Inventario
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.categorias.create') || Route::is('admin.categorias.index') || Route::is('admin.categorias.edit') || Route::is('admin.categorias.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.categorias.index')  || Route::is('admin.categorias.edit') ? 'active' : '' }}"><a href="{{ route('admin.categorias.index') }}">Gestion de categorias</a></li>
                            @endif
                        </ul>
                        <ul class="collapse {{ Route::is('admin.marcas.create') || Route::is('admin.marcas.index') || Route::is('admin.marcas.edit') || Route::is('admin.marcas.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.marcas.index')  || Route::is('admin.marcas.edit') ? 'active' : '' }}"><a href="{{ route('admin.marcas.index') }}">Tipos de marcas</a></li>
                            @endif
                        </ul>
                        <ul class="collapse {{ Route::is('admin.productos.create') || Route::is('admin.productos.index') || Route::is('admin.productos.edit') || Route::is('admin.productos.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.productos.index')  || Route::is('admin.productos.edit') ? 'active' : '' }}"><a href="{{ route('admin.productos.index') }}">productos</a></li>
                            @endif
                        </ul>


                    </li>
                    @endif


                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Almacen
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.almacenes.create') || Route::is('admin.almacenes.index') || Route::is('admin.almacenes.edit') || Route::is('admin.almaces.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.almacenes.index')  || Route::is('admin.almaces.edit') ? 'active' : '' }}"><a href="{{ route('admin.almacenes.index') }}">admistrar almacen</a></li>
                            @endif
                        </ul>
                        <ul class="collapse {{ Route::is('admin.transferencias.create') || Route::is('admin.transferencias.index') || Route::is('admin.transferencias.edit') || Route::is('admin.transferencias.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.transferencias.index')  || Route::is('admin.transferencias.edit') ? 'active' : '' }}"><a href="{{ route('admin.transferencias.index') }}">TransferenciaAlmacen</a></li>
                            @endif
                        </ul>
                        <ul class="collapse {{ Route::is('admin.ubicaciones.create') || Route::is('admin.ubicaciones.index') || Route::is('admin.ubicaciones.edit') || Route::is('admin.ubicaciones.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.ubicaciones.index')  || Route::is('admin.ubicaciones.edit') ? 'active' : '' }}"><a href="{{ route('admin.ubicaciones.index') }}">UbicacionProducto</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                        @if ($usr->can('proveedores.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Proveedores
                        </span></a>
                                <ul class="collapse {{ Route::is('admin.proveedores.create') || Route::is('admin.proveedores.index') || Route::is('admin.proveedores.edit') || Route::is('admin.proveedores.show') ? 'in' : '' }}">
                                    @if ($usr->can('role.view'))
                                        <li class="{{ Route::is('admin.proveedores.index')  || Route::is('admin.proveedores.edit') ? 'active' : '' }}"><a href="{{ route('admin.proveedores.index') }}">Proveedor</a></li>
                                    @endif
                                </ul>

                            </li>
                        @endif



                        @if ($usr->can('clientes.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Clientes
                        </span></a>
                                <ul class="collapse {{ Route::is('admin.clientes.create') || Route::is('admin.clientes.index') || Route::is('admin.clientes.edit') || Route::is('admin.clientes.show') ? 'in' : '' }}">
                                    @if ($usr->can('role.view'))
                                        <li class="{{ Route::is('admin.clientes.index')  || Route::is('admin.clientes.edit') ? 'active' : '' }}"><a href="{{ route('admin.clientes.index') }}">Clientes</a></li>
                                    @endif
                                </ul>

                            </li>
                        @endif
                        @if ($usr->can('compras.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                           Compras
                        </span></a>
                                <ul class="collapse {{ Route::is('admin.compras.create') || Route::is('admin.compras.index') || Route::is('admin.compras.edit') || Route::is('admin.compras.show') ? 'in' : '' }}">
                                    @if ($usr->can('role.view'))
                                        <li class="{{ Route::is('admin.compras.index')  || Route::is('admin.compras.edit') ? 'active' : '' }}"><a href="{{ route('admin.compras.index') }}">Ver</a></li>
                                    @endif
                                    @if ($usr->can('role.create'))
                                        <li class="{{ Route::is('admin.compras.create')  ? 'active' : '' }}"><a href="{{ route('admin.compras.create') }}">Create</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if ($usr->can('ventas.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                           Ventas
                        </span></a>
                                <ul class="collapse {{ Route::is('admin.ventas.create') || Route::is('admin.ventas.index') || Route::is('admin.ventas.edit') || Route::is('admin.ventas.show') ? 'in' : '' }}">
                                    @if ($usr->can('role.view'))
                                        <li class="{{ Route::is('admin.ventas.index')  || Route::is('admin.ventas.edit') ? 'active' : '' }}"><a href="{{ route('admin.ventas.index') }}">Ver</a></li>
                                    @endif
                                    @if ($usr->can('role.create'))
                                        <li class="{{ Route::is('admin.ventas.create')  ? 'active' : '' }}"><a href="{{ route('admin.ventas.create') }}">Create</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif



                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif


                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
