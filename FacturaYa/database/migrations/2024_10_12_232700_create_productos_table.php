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
            $table->string('codigo')->unique();
            $table->string('nombre')->nullable(false);
            $table->string('imagen')->nullable(true);
            $table->decimal('precio', 10, 2)->nullable(false);
            $table->decimal('medida', 5, 2)->nullable(false);
            $table->foreignId('categoria_id')->constrained();
            $table->foreignId('impuesto_id')->constrained();

            $table->foreign('categoria_id','fk_productos_categoria_id')
                ->references('id')->on('categorias')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('impuesto_id', 'fk_productos_impuesto_id')
                ->references('id')->on('impuestos')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
