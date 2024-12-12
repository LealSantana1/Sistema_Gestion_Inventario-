<?php

use App\Http\Controllers\compraController;
use App\Http\Controllers\ventaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TransferenciaAlmacenController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\UbicacionProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\ClienteController;
use App\Models\Cliente;
use App\Models\Proveedor;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Auth::routes();

// Home Routes
//Route::get('/', [HomeController::class, 'redirectAdmin'])->name('index');
//Route::get('/home', [HomeController::class, 'index'])->name('home');


// Admin Authentication Routes (public)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

Route::prefix('admin')->group(function () {
    Route::get('cotizaciones/pdf', [CotizacionController::class, 'pdf'])->name('admin.cotizaciones.pdf');
    Route::get('cotizaciones', [CotizacionController::class, 'index'])->name('admin.cotizaciones.index');
    Route::get('cotizaciones/create', [CotizacionController::class, 'create'])->name('admin.cotizaciones.create');
    Route::post('cotizaciones', [CotizacionController::class, 'store'])->name('admin.cotizaciones.store');
    Route::get('cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('admin.cotizaciones.edit');
    Route::put('cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('admin.cotizaciones.update');
    Route::delete('cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('admin.cotizaciones.destroy');
    Route::get('cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('admin.cotizaciones.show');

});


Route::prefix('admin')->group(function () {
    Route::resource('admin/categorias', CategoriaController::class);
   // Route::get('categorias/pdf', [CategoriaController::class, 'pdf'])->name('categorias.pdf');
    //Route::get('categorias/pdf', [CategoriasController::class, 'pdf'])->name('categorias.pdf');
    Route::get('categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('categorias/create', [CategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit'); // Changed {id} to {categoria}
    Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('admin.categorias.update'); // Changed {id} to {categoria}
    Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy'); // Changed {id} to {categoria}
});


Route::prefix('admin')->group(function () {
    // Route::get('marcas/pdf', [MarcaController::class, 'pdf'])->name('marcas.pdf');
     Route::get('marcas', [MarcaController::class, 'index'])->name('admin.marcas.index');
     Route::get('marcas/create', [MarcaController::class, 'create'])->name('admin.marcas.create');
     Route::post('marcas', [MarcaController::class, 'store'])->name('admin.marcas.store');
     Route::get('marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('admin.marcas.edit');
     Route::put('marcas/{marca}', [MarcaController::class, 'update'])->name('admin.marcas.update');
     Route::delete('marcas/{marca}', [MarcaController::class, 'destroy'])->name('admin.marcas.destroy');
 });




 Route::prefix('admin')->name('admin.')->group(function () {
    //Route::get('productos/pdf', [ProductosController::class, 'pdf'])->name('productos.pdf');
    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
   // Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search');
   Route::get('/productos/{id}/edit', [ProductoController::class, 'editAjax'])->name('productos.editAjax');
    Route::resource('admin/productos', ProductoController::class);

});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('transferencias', TransferenciaAlmacenController::class)
        ->parameters(['transferencias' => 'transferencia'])
        ->except(['show']);
});


Route::prefix('admin')->name('admin.')->group(function () {
  Route::resource('almacenes', AlmacenController::class)
    ->parameters(['almacenes' => 'almacen']);
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('transferencias')->name('transferencias.')->group(function () {
        Route::get('/', [TransferenciaAlmacenController::class, 'index'])->name('index');
        Route::get('create', [TransferenciaAlmacenController::class, 'create'])->name('create');
        Route::post('/', [TransferenciaAlmacenController::class, 'store'])->name('store');
        Route::get('{transferencia}/edit', [TransferenciaAlmacenController::class, 'edit'])->name('edit');
        Route::put('{transferencia}', [TransferenciaAlmacenController::class, 'update'])->name('update');
        Route::delete('{transferencia}', [TransferenciaAlmacenController::class, 'destroy'])->name('destroy');
    });
});




Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ubicaciones', UbicacionProductoController::class);
});


Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('cupones', CuponController::class);
});



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Aquí estamos utilizando Route Model Binding de Laravel.
    Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');



});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('compras', [CompraController::class, 'index'])->name('compras.index');
    Route::get('compras/create', [CompraController::class, 'create'])->name('compras.create');
    Route::post('compras', [CompraController::class, 'store'])->name('compras.store');
    Route::get('compras/{compra}/edit', [CompraController::class, 'edit'])->name('compras.edit');
    Route::put('compras/{compra}', [CompraController::class, 'update'])->name('compras.update');
    Route::delete('compras/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy');

    // Ruta para mostrar los detalles de una compra
    Route::get('compras/{compra}', [CompraController::class, 'show'])->name('compras.show');
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
    Route::delete('ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');

    // Ruta para mostrar los detalles de una compra
    Route::get('ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
});




Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::put('admin/clientes/{cliente}', [ClienteController::class, 'update'])->name('admin.clientes.update');

});

// Admin Routes (protected by auth:admin)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes for roles and admins
    Route::resource('roles', RolesController::class);
    Route::resource('admins', AdminsController::class);


    // Login Routes
    //Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    //Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

    // Logout Routes
    //Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');

    // Password Reset Routes
    //Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    //Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('password.update');
});
