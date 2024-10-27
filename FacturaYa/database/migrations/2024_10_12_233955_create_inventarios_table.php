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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable(false);
            $table->string('tipo_movimiento')->nullable(false);
            $table->integer('entrada')->nullable(true);
            $table->integer('salida')->nullable(true);
            $table->foreignId('producto_id')->constrained();

            $table->foreign('producto_id', 'fk_inventarios_producto_id')
                ->references('id')->on('productos')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
