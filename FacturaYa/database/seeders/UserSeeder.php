<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'supervisor']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@biblioteca.com',
            'password' => bcrypt('password'),
            'role' => 'administrador',
        ]);
        $admin->assignRole('administrador');

        $supervisor = User::create([
            'name' => 'Regular User',
            'email' => 'supervisor@biblioteca.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);
        $supervisor->assignRole('supervisor');
    }
}
