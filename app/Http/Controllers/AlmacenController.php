<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\UbicacionProducto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::with(['usuario', 'ubicaciones.producto'])->get();
        return view('almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        $usuarios = User::doesntHave('almacenes')->get();
        return view('almacenes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'estado' => 'required|boolean',
        ]);

        $almacen = Almacen::create($request->all());

        try {
            UbicacionProducto::create([
                'almacen_id' => $almacen->id,
                'producto_id' => null,
                'cantidad' => 0,
                'pasillo' => 'A',
                'estanteria' => '1',
            ]);
        } catch (Exception $e) {
            Log::error('Error al crear la ubicación para el almacén: ' . $e->getMessage());
    
            return back()->with('error', 'Hubo un error al crear la ubicación para el almacén.');
        }
        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén creado con éxito');

    }

    

    public function edit(Almacen $almacen)
    {
        $usuarios = User::doesntHave('almacenes')->orWhere('id', $almacen->user_id)->get();
        return view('almacenes.edit', compact('almacen', 'usuarios'));
    }

    public function update(Request $request, Almacen $almacen)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'estado' => 'required|boolean',
        ]);

        $almacen->update($request->all());

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén actualizado con éxito');
    }

    public function destroy(Almacen $almacen)
    {
        $almacen->delete();

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén eliminado con éxito');
    }
}
