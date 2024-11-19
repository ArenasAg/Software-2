<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'email' => 'admin@biblioteca.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        $supervisor = User::create([
            'email' => 'supervisor@biblioteca.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);
        $supervisor->assignRole('supervisor');
    }
}
