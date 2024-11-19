<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            [
                'numero_documento' => '1234567890',
                'nombre' => 'Juan Pérez',
                'direccion' => 'Calle 123 #45-67',
                'telefono' => '3001234567',
                'ciudad' => 'Bogotá',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_documento' => '0987654321',
                'nombre' => 'María Gómez',
                'direccion' => 'Carrera 10 #20-30',
                'telefono' => '3109876543',
                'ciudad' => 'Medellín',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_documento' => '1122334455',
                'nombre' => 'Carlos Rodríguez',
                'direccion' => 'Avenida 1 #2-3',
                'telefono' => '3201122334',
                'ciudad' => 'Cali',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_documento' => '5566778899',
                'nombre' => 'Ana Martínez',
                'direccion' => 'Calle 4 #5-6',
                'telefono' => '3005566778',
                'ciudad' => 'Barranquilla',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_documento' => '6677889900',
                'nombre' => 'Luis Fernández',
                'direccion' => 'Carrera 7 #8-9',
                'telefono' => '3106677889',
                'ciudad' => 'Cartagena',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($clientes as $cliente) {
            $clienteId = DB::table('clientes')->insertGetId($cliente);

            $nombreParts = explode(' ', $cliente['nombre']);
            $email = strtolower($nombreParts[0] . '.' . end($nombreParts)) . '@gmail.com';

            // Crear usuario asociado al cliente
            $user = User::firstOrCreate(
                ['cliente_id' => $clienteId],
                [
                    'email' => $email,
                    'password' => bcrypt('password'), // Cambia esto por una contraseña segura
                    'role' => 'cliente',
                ]
            );
            $user->assignRole('cliente');
        }
    }
}
