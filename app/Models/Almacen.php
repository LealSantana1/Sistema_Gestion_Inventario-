<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'almacenes';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'ubicacion',
        'user_id', 
        'estado',
    ];

    /**
     * Relación con el usuario asociado al almacén.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con las ubicaciones de productos.
     */
    public function ubicaciones()
    {
        return $this->hasMany(UbicacionProducto::class, 'almacen_id');
        return $this->hasMany(UbicacionProducto::class, 'producto_id');

    }


    /**
     * Relación con las transferencias como almacén de origen.
     */
    public function transferenciasOrigen()
    {
        return $this->hasMany(TransferenciaAlmacen::class, 'almacen_origen_id');
    }

    /**
     * Relación con las transferencias como almacén de destino.
     */
    public function transferenciasDestino()
    {
        return $this->hasMany(TransferenciaAlmacen::class, 'almacen_destino_id');
    }

    /**
     * Evento al crear un nuevo almacén.
     * Se crean automáticamente las ubicaciones de productos con cantidad inicial 0.
     */
    protected static function booted()
    {
        static::created(function ($almacen) {
            // Obtener todos los productos existentes
            $productos = \App\Models\Producto::all();

            // Crear una entrada para cada producto en la tabla ubicacion_productos
            foreach ($productos as $producto) {
                \App\Models\UbicacionProducto::create([
                    'producto_id' => $producto->id,
                    'almacen_id' => $almacen->id,
                    'cantidad' => 0, // Cantidad inicial
                ]);
            }
        });
    }
}
