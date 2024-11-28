<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\User;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::with('usuario')->get();
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
            'user_id' => 'required|exists:users,id', 
            'estado' => 'required|boolean',
        ]);

        Almacen::create($request->all());

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
            'user_id' => 'required|exists:users,id',
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
