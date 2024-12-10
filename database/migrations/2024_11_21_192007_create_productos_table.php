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
            $table->string('nombre',80);
            $table->string('Descripcion');
            $table->integer('stock')->unsigned()->default(0);
            $table->decimal('precio', 10, 2);
            $table->string('image')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->nullOnDelete();
            $table->timestamp('fecha_creacion')->nullable();
            $table->string('slug')->unique();
            $table->longText('detalles_adicionales')->nullable();
            $table->decimal('descuento', 5, 2)->nullable();
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
