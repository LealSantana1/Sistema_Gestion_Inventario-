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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique(); 
            $table->string('Descripcion'); 
            $table->integer('cantidad')->unsigned(); 
            $table->string('image')->nullable();  
            $table->foreignId('almacen_id')->nullable()->constrained('almacenes')->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->nullOnDelete(); 
            $table->timestamp('fecha_creacion')->nullable(); 
            $table->string('slug')->unique(); 
            $table->longText('detalles_adicionales')->nullable(); 
            $table->decimal('descuento', 5, 2)->nullable(); 
            $table->decimal('precio_venta', 10, 2)->default(0); 
            $table->decimal('precio_mayor', 10, 2)->default(0); 
            $table->decimal('precio_distribuidor', 10, 2)->default(0); 
            $table->decimal('precio_compra', 10, 2)->default(0); 
            $table->unsignedInteger('stock_minimo')->default(1);
            $table->unsignedInteger('stock_actual')->default(0);
            $table->integer('status')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

