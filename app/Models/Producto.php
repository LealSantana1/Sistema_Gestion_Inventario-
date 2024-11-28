<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'Descripcion',
        'cantidad',
        'precio_venta',
        'precio_mayor',
        'precio_distribuidor',
        'precio_compra',
        'image',
        'almacen_id',
        'categoria_id',
        'marca_id',
        'slug',
        'detalles_adicionales',
        'descuento',
        'stock_minimo',
        'stock_actual',
        'status',
        'fecha_creacion',
    ];



    public function producto()
    {
    return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }


    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];
}



