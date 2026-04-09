<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'SUPER ADMIN', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'ADMIN', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'EMPLEADO', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'CONTADOR', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'DEPOSITO', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'CLIENTE', 'guard_name' => 'web']);
    }
}