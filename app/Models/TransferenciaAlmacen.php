<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaAlmacen extends Model
{
    use HasFactory;

    protected $table = 'transferencias_almacenes';

   
    protected $fillable = [
        'almacen_origen_id',
        'almacen_destino_id',
        'producto_id',
        'cantidad',
        'usuario_id',
        'estado', 
    ];


    public function almacenOrigen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_origen_id');
    }


    public function almacenDestino()
    {
        return $this->belongsTo(Almacen::class, 'almacen_destino_id');
    }


    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

  
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

 
    public function getEstadoTextoAttribute()
    {
        return $this->estado === 'activo' ? 'Activo' : 'Anulado';
    }

    public function getFechaTransferenciaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}
