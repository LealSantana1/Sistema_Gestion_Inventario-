<?php

namespace App\Http\Controllers;

use App\Models\UbicacionProducto;
use Illuminate\Http\Request;

class UbicacionProductoController extends Controller
{
    /**
     * Mostrar una lista de ubicaciones.
     */
    public function index()
    {
        $ubicaciones = UbicacionProducto::with(['producto', 'almacen'])->get();
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    /**
     * Mostrar los detalles de una ubicación específica.
     */
    public function show($id)
    {
        $ubicacion = UbicacionProducto::with(['producto', 'almacen'])->findOrFail($id);
        return view('ubicaciones.show', compact('ubicacion'));
    }

    /**
     * Filtrar ubicaciones por producto o almacén.
     */
    public function search(Request $request)
    {
        $query = UbicacionProducto::query();

        if ($request->filled('producto_id')) {
            $query->where('producto_id', $request->producto_id);
        }

        if ($request->filled('almacen_id')) {
            $query->where('almacen_id', $request->almacen_id);
        }

        $ubicaciones = $query->with(['producto', 'almacen'])->get();
        return view('ubicaciones.index', compact('ubicaciones'));
    }
}
