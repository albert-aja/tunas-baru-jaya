<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'foto' => 'admin.png',
            'status' => '1',
        ]);

        $admin->assignRole('Admin');

        $owner = User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'email' => 'owner@mail.com',
            'password' => bcrypt('owner'),
            'foto' => 'admin.png',
            'status' => '1',
        ]);

        $owner->assignRole('Owner');

        $kasir = User::create([
            'name' => 'Kasir',
            'username' => 'kasir',
            'email' => 'kasir@mail.com',
            'password' => bcrypt('kasir'),
            'foto' => 'admin.png',
            'status' => '1',
        ]);

        $kasir->assignRole('Kasir');
    }
}
