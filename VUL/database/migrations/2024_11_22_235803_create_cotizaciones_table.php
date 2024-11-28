<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedores'); 
            $table->string('producto'); 
            $table->string('descripcion'); 
            $table->decimal('precio_unitario', 8, 2); 
            $table->integer('cantidad'); 
            $table->decimal('precio_total', 8, 2); 
            $table->decimal('impuesto', 8, 2)->nullable(); 
            $table->decimal('total_con_impuesto', 8, 2);
            $table->date('fecha_cotizacion'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
