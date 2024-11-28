<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Almacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Producto::query();

    if ($request->has('almacen_id') && $request->almacen_id) {
        $request->where('almacen_id', $request->almacen_id);
    }

    if ($request->has('categoria_id') && $request->categoria_id) {
        $query->where('categoria_id', $request->categoria_id);
    }

    if ($request->has('marca_id') && $request->marca_id) {
        $query->where('marca_id', $request->marca_id);
    }

    $productos = $query->get();

    $almacenes = Almacen::all();
    $categorias = Categoria::all();
    $marcas = Marca::all();
    

    return view('productos.index', compact('almacenes','productos', 'categorias', 'marcas'));
}


    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $almacenes = Almacen::all();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.create', compact('almacenes','categorias', 'marcas'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:255|unique:productos,sku',
            'Descripcion' => 'required|string|max:201155',
            'cantidad' => 'required|integer',
            'precio_venta' => 'required|numeric|min:0',
            'precio_distribuidor' => 'required|numeric',          
            'precio_compra' => 'required|numeric',            
            'precio_mayor' => 'required|numeric',          
            'almacen_id' => 'required|exists:almacenes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:productos,slug',
            'detalles_adicionales' => 'nullable|string',
            'stock_minimo' => 'required|integer|min:1',
            'stock_actual' => 'required|integer|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|integer',
            'fecha_creacion' => 'nullable|date',
        ]);

        $producto = new Producto();
        $producto->sku = $request->sku;
        $producto->Descripcion = $request->Descripcion;
        $producto->cantidad = $request->cantidad;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_distribuidor = $request->precio_distribuidor;
        $producto->precio_mayor = $request->precio_mayor;
        $producto->precio_compra = $request->precio_compra;
        $producto->almacen_id = $request->almacen_id;
        $producto->categoria_id = $request->categoria_id;
        $producto->marca_id = $request->marca_id;
        $producto->slug = $request->slug;
        $producto->detalles_adicionales = $request->detalles_adicionales;
        $producto->descuento = $request->descuento;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_actual = $request->stock_actual;
        $producto->status = $request->status;
        $producto->fecha_creacion = $request->fecha_creacion;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = 'producto/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $file->move(public_path($destinationPath), $filename);

            if ($uploadSuccess) {
                $producto->image = $destinationPath . $filename;
            }
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.edit', compact('almacen','producto', 'categorias', 'marcas'));
    }

    public function show($id)
{
    $producto = Producto::findOrFail($id); 
    return view('productos.detalles', compact('producto'));
}


    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'sku' => 'required|string|max:255|unique:productos,sku,' . $producto->id,
            'Descripcion' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'precio_venta' => 'required|numeric',
            'precio_distribuidor' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'precio_mayor', 'required|numeric',
            'almacen_id' => 'required|exists:almacenes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255|unique:productos,slug,' . $producto->id,
            'detalles_adicionales' => 'nullable|string',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'stock_minimo' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
            'status' => 'required|integer',
            'fecha_creacion' => 'nullable|date',
        ]);

        $producto->update($request->except('image'));

        if ($request->hasFile('image')) {
            if ($producto->image && Storage::exists('public/' . $producto->image)) {
                Storage::delete('public/' . $producto->image);
            }

            $file = $request->file('image');
            $destinationPath = 'producto/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $file->move(public_path($destinationPath), $filename);

            if ($uploadSuccess) {
                $producto->image = $destinationPath . $filename;
            }
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Producto $producto)
    {
        if ($producto->image && Storage::exists('public/' . $producto->image)) {
            Storage::delete('public/' . $producto->image);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}






