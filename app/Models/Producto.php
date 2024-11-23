<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'Descripcion',
        'cantidad',
        'precio',
        'image',
        'categoria_id',
        'marca_id',
        'slug',
        'detalles_adicionales',
        'descuento',
        'status',
        'fecha_creacion',
    ];

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