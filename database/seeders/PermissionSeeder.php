<?php

namespace Database\Seeders;

use App\Models\Config\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Melihat Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Satuan Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Satuan Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Satuan Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Kategori Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Kategori Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Kategori Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Jenis Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Jenis Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Jenis Koreksi Stok Produk',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Melihat Customer',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Customer',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Customer',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Customer',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Melihat Pembelian',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Pembelian',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Pembelian',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Pembelian',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Melihat Penjualan',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menambah Penjualan',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Mengubah Penjualan',
            'guard_name' => 'web',
        ]);
        sleep(1);
        Permission::create([
            'name' => 'Menghapus Penjualan',
            'guard_name' => 'web',
        ]);
    }
}
