<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos en español
        Permission::create(['name' => 'ver reportes']);
        Permission::create(['name' => 'descargar reportes']);
        Permission::create(['name' => 'ver perfil']);
        Permission::create(['name' => 'editar perfil']);
        Permission::create(['name' => 'ver compras']);
        Permission::create(['name' => 'ver categorias']);
        Permission::create(['name' => 'ver clientes']);
        Permission::create(['name' => 'ver facturas']);
        Permission::create(['name' => 'ver impuestos']);
        Permission::create(['name' => 'ver informes']);
        Permission::create(['name' => 'ver inventarios']);
        Permission::create(['name' => 'ver metodoPagos']);
        Permission::create(['name' => 'ver libros']);

        // Crear roles y asignar permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $supervisorRole = Role::create(['name' => 'supervisor']);
        $supervisorRole->givePermissionTo([
            'ver reportes',
            'descargar reportes',
        ]);

        $clientRole = Role::create(['name' => 'cliente']);
        $clientRole->givePermissionTo([
            'ver perfil',
            'editar perfil',
            'ver compras',
        ]);
    }
}
