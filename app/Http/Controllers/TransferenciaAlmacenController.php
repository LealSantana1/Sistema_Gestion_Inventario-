<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Producto;
use App\Models\TransferenciaAlmacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferenciaAlmacenController extends Controller
{
    /**
     * Mostrar el listado de transferencias.
     */
    public function index()
    {
        $transferencias = TransferenciaAlmacen::with(['almacenOrigen', 'almacenDestino', 'producto', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transferencias.index', compact('transferencias'));
    }

    /**
     * Mostrar el formulario para crear una nueva transferencia.
     */
    public function create()
    {
        $almacenes = Almacen::all();
        $productos = Producto::all();

        return view('transferencias.create', compact('almacenes', 'productos'));
    }

    /**
     * Guardar una nueva transferencia.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'almacen_origen_id' => 'required|exists:almacenes,id',
            'almacen_destino_id' => 'required|exists:almacenes,id|different:almacen_origen_id',
            'productos' => 'required|array', // Asegurarse de que el campo productos esté presente
            'productos.*.id' => 'required|exists:productos,id', // Cada producto debe tener un ID válido
            'productos.*.cantidad' => 'required|integer|min:1', // Cada producto debe tener una cantidad válida
        ]);

        // Iniciar una transacción para garantizar que todo se ejecute correctamente
        DB::beginTransaction();

        try {
            foreach ($validated['productos'] as $producto) {
                // Obtener el producto del inventario
                $productoModel = Producto::findOrFail($producto['id']);

                // Validar que haya stock suficiente en el almacén de origen
                if ($productoModel->stock_actual < $producto['cantidad']) {
                    return redirect()->back()->withErrors([
                        'error' => "Stock insuficiente para el producto: {$productoModel->nombre}",
                    ]);
                }

                // Reducir el stock en el almacén de origen
                $productoModel->stock_actual -= $producto['cantidad'];
                $productoModel->save();

                // Crear la transferencia de almacén
                TransferenciaAlmacen::create([
                    'almacen_origen_id' => $validated['almacen_origen_id'],
                    'almacen_destino_id' => $validated['almacen_destino_id'],
                    'producto_id' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'usuario_id' => Auth::id(),
                    'estado' => 'activo',
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('admin.transferencias.index')->with('success', 'Transferencia realizada con éxito.');

        } catch (\Exception $e) {
            // Si ocurre algún error, revertir la transacción
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al procesar la transferencia.']);
        }
    }

    /**
     * Mostrar los detalles de una transferencia específica.
     */
    public function show($id)
    {
        $transferencia = TransferenciaAlmacen::with(['almacenOrigen', 'almacenDestino', 'producto', 'usuario'])
            ->findOrFail($id);

        return view('transferencias.show', compact('transferencia'));
    }

    /**
     * Anular una transferencia.
     */
    public function anular($id)
    {
        $transferencia = TransferenciaAlmacen::findOrFail($id);

        if ($transferencia->estado === 'anulado') {
            return redirect()->back()->withErrors(['error' => 'Esta transferencia ya está anulada.']);
        }

        $producto = Producto::findOrFail($transferencia->producto_id);
        $producto->stock_actual += $transferencia->cantidad;
        $producto->save();

        $transferencia->estado = 'anulado';
        $transferencia->save();

        return redirect()->route('admin.transferencias.index')->with('success', 'Transferencia anulada correctamente.');
    }
}
