<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Transferencia;
use App\Models\TransferenciaAlmacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferenciaAlmacenController extends Controller
{
    public function create()
    {
        $almacenes = Almacen::all();
        $productos = Producto::all();

        return view('backend.transferencias.create', compact('almacenes', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'almacen_origen_id' => 'required|exists:almacenes,id',
            'almacen_destino_id' => 'required|exists:almacenes,id|different:almacen_origen_id',
            'producto_id' => 'required|exists:products,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $almacenOrigen = Almacen::findOrFail($validated['almacen_origen_id']);
            $almacenDestino = Almacen::findOrFail($validated['almacen_destino_id']);
            $producto = Producto::findOrFail($validated['producto_id']);

            if ($producto->stock_actual < $validated['cantidad']) {
                throw new \Exception('Stock insuficiente en el almacén origen.');
            }

            $producto->stock_actual -= $validated['cantidad'];
            $producto->almacen_id = $validated['almacen_origen_id'];
            $producto->save();

            $productoDestino = Producto::where('sku', $producto->sku)
                                      ->where('almacen_id', $validated['almacen_destino_id'])
                                      ->first();

            if ($productoDestino) {
                $productoDestino->stock_actual += $validated['cantidad'];
                $productoDestino->save();
            } else {
                Producto::create([
                    'sku' => $producto->sku,
                    'descripcion' => $producto->descripcion,
                    'cantidad' => $producto->cantidad,
                    'precio' => $producto->precio,
                    'unidad_medida' => $producto->unidad_medida,
                    'precio_venta' => $producto->precio_venta,
                    'precio_mayor' => $producto->precio_mayor,
                    'precio_distribuidor' => $producto->precio_distribuidor,
                    'precio_compra' => $producto->precio_compra,
                    'stock_minimo' => $producto->stock_minimo,
                    'stock_actual' => $validated['cantidad'],
                    'image' => $producto->image,
                    'categoria_id' => $producto->categoria_id,
                    'marca_id' => $producto->marca_id,
                    'fecha_creacion' => now(),
                    'slug' => $producto->slug . '-' . $validated['almacen_destino_id'],
                    'detalles_adicionales' => $producto->detalles_adicionales,
                    'descuento' => $producto->descuento,
                    'status' => $producto->status,
                    'almacen_id' => $validated['almacen_destino_id'],
                ]);
            }

            TransferenciaAlmacen::create($validated);
        });

        return redirect()->route('admin.transferencias.create')->with('success', 'Transferencia realizada con éxito.');
    }
}







