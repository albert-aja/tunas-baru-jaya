<?php

namespace Database\Seeders;

use App\Models\Config\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Owner',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Kasir',
            'guard_name' => 'web',
        ]);
    }
}
