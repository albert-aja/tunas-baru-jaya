<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use App\Models\Config\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            if ($role->name == 'Admin') {
                Menu::create([
                    'judul' => 'Beranda',
                    'icon' => 'fas fa-home',
                    'link' => 'admin/beranda',
                    'source' => 'Beranda',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Produk',
                    'icon' => 'fas fa-boxes',
                    'link' => 'admin/produk',
                    'source' => 'Produk',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Customer',
                    'icon' => 'fas fa-users',
                    'link' => 'admin/customer',
                    'source' => 'Customer',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Pembelian',
                    'icon' => 'fas fa-cart-plus',
                    'link' => 'admin/pembelian',
                    'source' => 'Pembelian',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Penjualan',
                    'icon' => 'fas fa-cash-register',
                    'link' => 'admin/penjualan',
                    'source' => 'Penjualan',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Pengguna',
                    'icon' => 'fas fa-users',
                    'link' => 'admin/pengguna',
                    'source' => 'Pengguna',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Pengaturan',
                    'icon' => 'fas fa-cogs',
                    'link' => 'admin/pengaturan',
                    'source' => 'Pengaturan',
                    'role' => $role['id'],
                ]);
            } else if ($role->name == 'Kasir') {
                Menu::create([
                    'judul' => 'Beranda',
                    'icon' => 'fas fa-home',
                    'link' => 'kasir/beranda',
                    'source' => 'Beranda',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Produk',
                    'icon' => 'fas fa-boxes',
                    'link' => 'kasir/produk',
                    'source' => 'Produk',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Customer',
                    'icon' => 'fas fa-users',
                    'link' => 'kasir/customer',
                    'source' => 'Customer',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Pembelian',
                    'icon' => 'fas fa-cart-plus',
                    'link' => 'kasir/pembelian',
                    'source' => 'Pembelian',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Penjualan',
                    'icon' => 'fas fa-cash-register',
                    'link' => 'kasir/penjualan',
                    'source' => 'Penjualan',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Pengaturan',
                    'icon' => 'fas fa-cogs',
                    'link' => 'kasir/pengaturan',
                    'source' => 'Pengaturan',
                    'role' => $role['id'],
                ]);
            } else if ($role->name == 'Owner') {
                Menu::create([
                    'judul' => 'Beranda',
                    'icon' => 'fas fa-home',
                    'link' => 'owner/beranda',
                    'source' => 'Beranda',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Produk',
                    'icon' => 'fas fa-boxes',
                    'link' => 'owner/produk',
                    'source' => 'Produk',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Customer',
                    'icon' => 'fas fa-users',
                    'link' => 'owner/customer',
                    'source' => 'Customer',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Laporan Pembelian',
                    'icon' => 'far fa-copy',
                    'link' => 'owner/laporan-pembelian',
                    'source' => 'Laporan Pembelian',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Laporan Penjualan',
                    'icon' => 'far fa-copy',
                    'link' => 'owner/laporan-penjualan',
                    'source' => 'Laporan Penjualan',
                    'role' => $role['id'],
                ]);
                sleep(1);
                Menu::create([
                    'judul' => 'Laporan Utang',
                    'icon' => 'far fa-copy',
                    'link' => 'owner/laporan-utang',
                    'source' => 'Laporan Utang',
                    'role' => $role['id'],
                ]);
                sleep(1);
            }
        }
    }
}
