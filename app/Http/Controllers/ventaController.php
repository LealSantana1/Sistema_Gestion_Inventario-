<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ventaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['comprobante', 'cliente.persona', 'user'])
            ->where('estado', 1)
            ->latest()
            ->get();

        return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subquery = DB::table('compra_producto')
            ->select('producto_id', DB::raw('MAX(created_at) as max_created_at'))
            ->groupBy('producto_id');

        // Obtener los productos disponibles
        $productos = Producto::join('compra_producto as cpr', function ($join) use ($subquery) {
            $join->on('cpr.producto_id', '=', 'productos.id')
                ->whereIn('cpr.created_at', function ($query) use ($subquery) {
                    $query->select('max_created_at')
                        ->fromSub($subquery, 'subquery')
                        ->whereRaw('subquery.producto_id = cpr.producto_id');
                });
        })
            ->select('productos.nombre', 'productos.id', 'productos.stock', 'cpr.precio_venta')
            ->where('productos.estado', 1)
            ->where('productos.stock', '>', 0)
            ->get();

        // Obtener clientes activos
        $clientes = Cliente::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();

        // Obtener comprobantes disponibles
        $comprobantes = Comprobante::all();

        // Pasar los datos a la vista
        return view('venta.create', compact('productos', 'clientes', 'comprobantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request)
    {
        try {
            DB::beginTransaction();

            // Verifica todos los datos que se están enviando
            // dd($request->all());  // Esto te mostrará todos los datos enviados por el formulario

            // Asegúrate de que 'fecha_hora' se está enviando correctamente desde el formulario
            $fecha = Carbon::parse($request->fecha_hora); // Aquí cambiamos de 'fecha' a 'fecha_hora'

            // Verifica que 'total' esté presente
            $total = $request->total;

            // Llenar la tabla venta
            $venta = Venta::create(array_merge($request->validated(), ['fecha_hora' => $fecha, 'total' => $total])); // Añadimos 'total'

            // Recuperar los arrays enviados desde el formulario
            $arrayProducto_id = $request->get('arrayidproducto', []); // Valor por defecto es array vacío
            $arrayCantidad = $request->get('arraycantidad', []); // Valor por defecto es array vacío
            $arrayPrecioVenta = $request->get('arrayprecioventa', []); // Valor por defecto es array vacío
            $arrayDescuento = $request->get('arraydescuento', []); // Valor por defecto es array vacío

            // Verifica si los arrays no están vacíos
            if (empty($arrayProducto_id) || empty($arrayCantidad) || empty($arrayPrecioVenta) || empty($arrayDescuento)) {
                return redirect()->back()->with('error', 'No se proporcionaron productos válidos.');
            }

            $sizeArray = count($arrayProducto_id);
            $cont = 0;

            while ($cont < $sizeArray) {
                // Sincronizar los productos con la venta
                $venta->productos()->syncWithoutDetaching([
                    $arrayProducto_id[$cont] => [
                        'cantidad' => $arrayCantidad[$cont],
                        'precio_venta' => $arrayPrecioVenta[$cont],
                        'descuento' => $arrayDescuento[$cont]
                    ]
                ]);

                // Obtener el producto y verificar el stock
                $producto = Producto::find($arrayProducto_id[$cont]);
                $stockActual = $producto->stock;
                $cantidad = intval($arrayCantidad[$cont]);

                // Verificar si hay suficiente stock
                if ($cantidad > $stockActual) {
                    return redirect()->back()->with('error', 'No hay suficiente stock para el producto: ' . $producto->nombre);
                }

                // Restar la cantidad vendida del inventario
                DB::table('productos')
                    ->where('id', $producto->id)
                    ->update([
                        'stock' => $stockActual - $cantidad
                    ]);

                $cont++;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // Manejar el error adecuadamente si es necesario
            return redirect()->route('admin.ventas.index')->with('error', 'Error al procesar la venta: ' . $e->getMessage());
        }

        // Redirigir a la lista de ventas con un mensaje de éxito
        return redirect()->route('admin.ventas.index')->with('success', 'Venta exitosa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Venta::where('id', $id)
            ->update([
                'estado' => 0
            ]);

        return redirect()->route('admin.ventas.index')->with('success', 'Venta eliminada');
    }
}
