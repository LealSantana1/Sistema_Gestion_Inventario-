<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function Documento(){
        return $this->belongsTo(Documento::class);
    }

    public function Proveedor(){
        return $this->hasOne(Proveedor::class);
    }
    public function Cliente(){
        return $this->hasOne(Cliente::class);
    }

    protected $fillable = ['razon_social','direccion','tipo_persona','documento_id','numero_documento'];
}
