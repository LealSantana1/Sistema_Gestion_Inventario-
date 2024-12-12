<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::with('persona.documento')->get();
        $documentos = Documento::all();
        return view('proveedor.index', compact('proveedores', 'documentos'));
    }

    public function create()
    {
        $documentos = Documento::all();
        return view('proveedor.create', compact('documentos'));
    }

    public function store(StorePersonaRequest $request)
    {
        try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedor()->create([
                'persona_id' => $persona->id
            ]);
            DB::commit();
            return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor registrado');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar proveedor: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()->route('admin.proveedores.index')->with('error', 'Hubo un problema al registrar el proveedor.');
        }
    }

    public function show(string $id)
    {
    }

    public function edit(Proveedor $proveedor)
    {
        if (!$proveedor || !$proveedor->persona) {
            abort(404, 'Proveedor o Persona no encontrado');
        }
        $proveedor->load('persona.documento');
        $documentos = Documento::all();
        return view('proveedor.edit', compact('proveedor', 'documentos'));
    }

    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        try {
            DB::beginTransaction();
            if (!$proveedor->persona) {
                abort(404, 'Persona asociada al proveedor no encontrada');
            }
            Persona::where('id', $proveedor->persona->id)
                ->update($request->validated());
            DB::commit();
            return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor editado');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al editar proveedor: ' . $e->getMessage(), ['request' => $request->all(), 'proveedor_id' => $proveedor->id]);
            return redirect()->route('admin.proveedores.index')->with('error', 'Hubo un problema al editar el proveedor.');
        }
    }

    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);

        if (!$persona) {
            return redirect()->route('admin.proveedores.index')->with('error', 'Persona no encontrada');
        }

        if ($persona->proveedor) {
            $persona->proveedor()->delete();
        }

        $persona->delete();

        $message = 'Proveedor y persona eliminados permanentemente';

        return redirect()->route('admin.proveedores.index')->with('success', $message);
    }
}
