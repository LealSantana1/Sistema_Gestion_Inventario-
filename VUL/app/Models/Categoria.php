<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; 

    protected $fillable = [
        'name', 
        'descripcion',
    ];

    public $timestamps = true;

    protected $casts = [
        'descripcion' => 'string',
    ];
}
