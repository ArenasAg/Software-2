<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metodo_pagos')->insert([
            [
                'nombre' => 'Efectivo',
                'identificador' => 'EF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tarjeta de Crédito',
                'identificador' => 'TC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tarjeta de Débito',
                'identificador' => 'TD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Transferencia Bancaria',
                'identificador' => 'TB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PayPal',
                'identificador' => 'PP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
