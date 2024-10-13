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
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('valor_total', 8, 2);
            $table->decimal('descuento', 5, 2);
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('factura_id')->constrained();

            $table->foreign('producto_id', 'fk_detalle_facturas_producto_id')
                ->references('id')->on('productos')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('factura_id', 'fk_detalle_facturas_factura_id')
                ->references('id')->on('facturas')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_facturas');
    }
};
