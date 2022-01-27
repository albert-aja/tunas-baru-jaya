<?php

use App\Models\Config\Menu;
use App\Models\Config\Role;
use App\Models\Customer;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Ref\Produk\JenisKoreksi;
use App\Models\Ref\Produk\Kategori;
use App\Models\Ref\Produk\Satuan;
use App\Models\Supplier;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;

// Admin //
// Beranda
Breadcrumbs::for('Admin Beranda', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Beranda'],
    ])->first();
    $trail->push($menu->judul, route('Admin Beranda'), ['icon' => $menu->icon]);
});

// Profil
Breadcrumbs::for('Admin Profil', function ($trail) {
    $trail->push('Profil', route('Admin Profil'), ['icon' => 'far fa-user']);
});

Breadcrumbs::for('Admin Profil Edit', function ($trail) {
    $trail->parent('Admin Profil');
    $trail->push('Sunting Data', route('Admin Profil Edit'), ['icon' => '']);
});

// Produk
Breadcrumbs::for('Admin Produk', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Produk'],
    ])->first();
    $trail->push($menu->judul, route('Admin Produk'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Produk Create', function ($trail) {
    $trail->parent('Admin Produk');
    $trail->push('Tambah Data', route('Admin Produk Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Produk Show', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Admin Produk');
    $trail->push($data->nama, route('Admin Produk Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Produk Edit', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Admin Produk Show', $data->id);
    $trail->push('Sunting Data', route('Admin Produk Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Produk Koreksi Create', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Admin Produk Show', $data->id);
    $trail->push('Tambah Koreksi', route('Admin Produk Koreksi Create', $data), ['icon' => '']);
});

// Customer
Breadcrumbs::for('Admin Customer', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Customer'],
    ])->first();
    $trail->push($menu->judul, route('Admin Customer'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Customer Create', function ($trail) {
    $trail->parent('Admin Customer');
    $trail->push('Tambah Data', route('Admin Customer Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Customer Show', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Admin Customer');
    $trail->push($data->nama, route('Admin Customer Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Customer Edit', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Admin Customer Show', $data->id);
    $trail->push('Sunting Data', route('Admin Customer Edit', $data), ['icon' => '']);
});

// Supplier
Breadcrumbs::for('Admin Supplier', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Supplier'],
    ])->first();
    $trail->push($menu->judul, route('Admin Supplier'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Supplier Create', function ($trail) {
    $trail->parent('Admin Supplier');
    $trail->push('Tambah Data', route('Admin Supplier Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Supplier Show', function ($trail, $id) {
    $data = Supplier::findOrFail($id);
    $trail->parent('Admin Supplier');
    $trail->push($data->nama, route('Admin Supplier Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Supplier Edit', function ($trail, $id) {
    $data = Supplier::findOrFail($id);
    $trail->parent('Admin Supplier Show', $data->id);
    $trail->push('Sunting Data', route('Admin Supplier Edit', $data), ['icon' => '']);
});

// Pembelian
Breadcrumbs::for('Admin Pembelian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pembelian'],
    ])->first();
    $trail->push($menu->judul, route('Admin Pembelian'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Pembelian Create', function ($trail) {
    $trail->parent('Admin Pembelian');
    $trail->push('Tambah Data', route('Admin Pembelian Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Pembelian Show', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Admin Pembelian');
    $trail->push($data->no_faktur, route('Admin Pembelian Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pembelian Edit', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Admin Pembelian Show', $data->id);
    $trail->push('Sunting Data', route('Admin Pembelian Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pembelian Item Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Admin Pembelian Show', $data->id);
    $trail->push('Tambah Produk', route('Admin Pembelian Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pembelian Pembayaran Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Admin Pembelian Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Admin Pembelian Pembayaran Create', $data), ['icon' => '']);
});

// Penjualan
Breadcrumbs::for('Admin Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Penjualan'],
    ])->first();
    $trail->push($menu->judul, route('Admin Penjualan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Penjualan Create', function ($trail) {
    $trail->parent('Admin Penjualan');
    $trail->push('Tambah Data', route('Admin Penjualan Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Show', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Admin Penjualan');
    $trail->push($data->no_faktur, route('Admin Penjualan Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Edit', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Admin Penjualan Show', $data->id);
    $trail->push('Sunting Data', route('Admin Penjualan Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Item Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Admin Penjualan Show', $data->id);
    $trail->push('Tambah Produk', route('Admin Penjualan Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Pembayaran Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Admin Penjualan Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Admin Penjualan Pembayaran Create', $data), ['icon' => '']);
});

// Pengguna
Breadcrumbs::for('Admin Pengguna', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pengguna'],
    ])->first();
    $trail->push($menu->judul, route('Admin Pengguna'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Pengguna Create', function ($trail) {
    $trail->parent('Admin Pengguna');
    $trail->push('Tambah Data', route('Admin Pengguna Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengguna Show', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Admin Pengguna');
    $trail->push($data->name, route('Admin Pengguna Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengguna Edit', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Admin Pengguna Show', $data->id);
    $trail->push('Sunting Data', route('Admin Pengguna Edit', $data), ['icon' => '']);
});

// Pengaturan
Breadcrumbs::for('Admin Pengaturan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pengaturan'],
    ])->first();
    $trail->push($menu->judul, route('Admin Pengaturan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Pengaturan Izin Level Akses Edit', function ($trail, $id) {
    $data = Role::findOrFail($id);
    $trail->parent('Admin Pengaturan');
    $trail->push('Sunting Izin Level Akses ' . $data->name, route('Admin Pengaturan Izin Level Akses Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Kategori Create', function ($trail) {
    $trail->parent('Admin Pengaturan');
    $trail->push('Tambah Produk Kategori', route('Admin Pengaturan Produk Kategori Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Kategori Edit', function ($trail, $id) {
    $data = Kategori::findOrFail($id);
    $trail->parent('Admin Pengaturan');
    $trail->push('Sunting Produk Kategori ' . $data->nama, route('Admin Pengaturan Produk Kategori Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Satuan Create', function ($trail) {
    $trail->parent('Admin Pengaturan');
    $trail->push('Tambah Produk Satuan', route('Admin Pengaturan Produk Satuan Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Satuan Edit', function ($trail, $id) {
    $data = Satuan::findOrFail($id);
    $trail->parent('Admin Pengaturan');
    $trail->push('Sunting Produk Satuan ' . $data->nama, route('Admin Pengaturan Produk Satuan Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Jenis Koreksi Create', function ($trail) {
    $trail->parent('Admin Pengaturan');
    $trail->push('Tambah Produk Jenis Koreksi', route('Admin Pengaturan Produk Jenis Koreksi Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Pengaturan Produk Jenis Koreksi Edit', function ($trail, $id) {
    $data = JenisKoreksi::findOrFail($id);
    $trail->parent('Admin Pengaturan');
    $trail->push('Sunting Produk Jenis Koreksi ' . $data->nama, route('Admin Pengaturan Produk Jenis Koreksi Create', $data), ['icon' => '']);
});

// Kasir //
// Beranda
Breadcrumbs::for('Kasir Beranda', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Beranda'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Beranda'), ['icon' => $menu->icon]);
});

// Profil
Breadcrumbs::for('Kasir Profil', function ($trail) {
    $trail->push('Profil', route('Kasir Profil'), ['icon' => 'far fa-user']);
});

Breadcrumbs::for('Kasir Profil Edit', function ($trail) {
    $trail->parent('Kasir Profil');
    $trail->push('Sunting Data', route('Kasir Profil Edit'), ['icon' => '']);
});

// Produk
Breadcrumbs::for('Kasir Produk', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Produk'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Produk'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Kasir Produk Create', function ($trail) {
    $trail->parent('Kasir Produk');
    $trail->push('Tambah Data', route('Kasir Produk Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Produk Show', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Kasir Produk');
    $trail->push($data->nama, route('Kasir Produk Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Produk Edit', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Kasir Produk Show', $data->id);
    $trail->push('Sunting Data', route('Kasir Produk Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Produk Koreksi Create', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Kasir Produk Show', $data->id);
    $trail->push('Tambah Koreksi', route('Kasir Produk Koreksi Create', $data), ['icon' => '']);
});

// Customer
Breadcrumbs::for('Kasir Customer', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Customer'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Customer'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Kasir Customer Create', function ($trail) {
    $trail->parent('Kasir Customer');
    $trail->push('Tambah Data', route('Kasir Customer Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Customer Show', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Kasir Customer');
    $trail->push($data->nama, route('Kasir Customer Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Customer Edit', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Kasir Customer Show', $data->id);
    $trail->push('Sunting Data', route('Kasir Customer Edit', $data), ['icon' => '']);
});

// Pembelian
Breadcrumbs::for('Kasir Pembelian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pembelian'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Pembelian'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Kasir Pembelian Create', function ($trail) {
    $trail->parent('Kasir Pembelian');
    $trail->push('Tambah Data', route('Kasir Pembelian Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pembelian Show', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Kasir Pembelian');
    $trail->push($data->no_faktur, route('Kasir Pembelian Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pembelian Edit', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Kasir Pembelian Show', $data->id);
    $trail->push('Sunting Data', route('Kasir Pembelian Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pembelian Item Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Kasir Pembelian Show', $data->id);
    $trail->push('Tambah Produk', route('Kasir Pembelian Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pembelian Pembayaran Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Kasir Pembelian Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Kasir Pembelian Pembayaran Create', $data), ['icon' => '']);
});

// Penjualan
Breadcrumbs::for('Kasir Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Penjualan'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Penjualan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Kasir Penjualan Create', function ($trail) {
    $trail->parent('Kasir Penjualan');
    $trail->push('Tambah Data', route('Kasir Penjualan Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Penjualan Show', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Kasir Penjualan');
    $trail->push($data->no_faktur, route('Kasir Penjualan Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Penjualan Edit', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Kasir Penjualan Show', $data->id);
    $trail->push('Sunting Data', route('Kasir Penjualan Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Penjualan Item Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Kasir Penjualan Show', $data->id);
    $trail->push('Tambah Produk', route('Kasir Penjualan Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Penjualan Pembayaran Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Kasir Penjualan Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Kasir Penjualan Pembayaran Create', $data), ['icon' => '']);
});

// Pengaturan
Breadcrumbs::for('Kasir Pengaturan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pengaturan'],
    ])->first();
    $trail->push($menu->judul, route('Kasir Pengaturan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Kasir Pengaturan Produk Kategori Create', function ($trail) {
    $trail->parent('Kasir Pengaturan');
    $trail->push('Tambah Produk Kategori', route('Kasir Pengaturan Produk Kategori Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pengaturan Produk Kategori Edit', function ($trail, $id) {
    $data = Kategori::findOrFail($id);
    $trail->parent('Kasir Pengaturan');
    $trail->push('Sunting Produk Kategori ' . $data->nama, route('Kasir Pengaturan Produk Kategori Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pengaturan Produk Satuan Create', function ($trail) {
    $trail->parent('Kasir Pengaturan');
    $trail->push('Tambah Produk Satuan', route('Kasir Pengaturan Produk Satuan Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pengaturan Produk Satuan Edit', function ($trail, $id) {
    $data = Satuan::findOrFail($id);
    $trail->parent('Kasir Pengaturan');
    $trail->push('Sunting Produk Satuan ' . $data->nama, route('Kasir Pengaturan Produk Satuan Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pengaturan Produk Jenis Koreksi Create', function ($trail) {
    $trail->parent('Kasir Pengaturan');
    $trail->push('Tambah Produk Jenis Koreksi', route('Kasir Pengaturan Produk Jenis Koreksi Create'), ['icon' => '']);
});

Breadcrumbs::for('Kasir Pengaturan Produk Jenis Koreksi Edit', function ($trail, $id) {
    $data = JenisKoreksi::findOrFail($id);
    $trail->parent('Kasir Pengaturan');
    $trail->push('Sunting Produk Jenis Koreksi ' . $data->nama, route('Kasir Pengaturan Produk Jenis Koreksi Create', $data), ['icon' => '']);
});

// Owner //
// Beranda
Breadcrumbs::for('Owner Beranda', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Beranda'],
    ])->first();
    $trail->push($menu->judul, route('Owner Beranda'), ['icon' => $menu->icon]);
});

// Profil
Breadcrumbs::for('Owner Profil', function ($trail) {
    $trail->push('Profil', route('Owner Profil'), ['icon' => 'far fa-user']);
});

Breadcrumbs::for('Owner Profil Edit', function ($trail) {
    $trail->parent('Owner Profil');
    $trail->push('Sunting Data', route('Owner Profil Edit'), ['icon' => '']);
});

// Produk
Breadcrumbs::for('Owner Produk', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Produk'],
    ])->first();
    $trail->push($menu->judul, route('Owner Produk'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Produk Create', function ($trail) {
    $trail->parent('Owner Produk');
    $trail->push('Tambah Data', route('Owner Produk Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Produk Show', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Owner Produk');
    $trail->push($data->nama, route('Owner Produk Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Produk Edit', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Owner Produk Show', $data->id);
    $trail->push('Sunting Data', route('Owner Produk Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Produk Koreksi Create', function ($trail, $id) {
    $data = Produk::findOrFail($id);
    $trail->parent('Owner Produk Show', $data->id);
    $trail->push('Tambah Koreksi', route('Owner Produk Koreksi Create', $data), ['icon' => '']);
});

// Customer
Breadcrumbs::for('Owner Customer', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Customer'],
    ])->first();
    $trail->push($menu->judul, route('Owner Customer'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Customer Create', function ($trail) {
    $trail->parent('Owner Customer');
    $trail->push('Tambah Data', route('Owner Customer Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Customer Show', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Owner Customer');
    $trail->push($data->nama, route('Owner Customer Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Customer Edit', function ($trail, $id) {
    $data = Customer::findOrFail($id);
    $trail->parent('Owner Customer Show', $data->id);
    $trail->push('Sunting Data', route('Owner Customer Edit', $data), ['icon' => '']);
});

// Supplier
Breadcrumbs::for('Owner Supplier', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Supplier'],
    ])->first();
    $trail->push($menu->judul, route('Owner Supplier'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Supplier Create', function ($trail) {
    $trail->parent('Owner Supplier');
    $trail->push('Tambah Data', route('Owner Supplier Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Supplier Show', function ($trail, $id) {
    $data = Supplier::findOrFail($id);
    $trail->parent('Owner Supplier');
    $trail->push($data->nama, route('Owner Supplier Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Supplier Edit', function ($trail, $id) {
    $data = Supplier::findOrFail($id);
    $trail->parent('Owner Supplier Show', $data->id);
    $trail->push('Sunting Data', route('Owner Supplier Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Laporan Pembelian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Laporan Pembelian'],
    ])->first();
    $trail->push($menu->judul, route('Owner Laporan Pembelian'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Laporan Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Laporan Penjualan'],
    ])->first();
    $trail->push($menu->judul, route('Owner Laporan Penjualan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Laporan Utang', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Laporan Utang'],
    ])->first();
    $trail->push($menu->judul, route('Owner Laporan Utang'), ['icon' => $menu->icon]);
});

// Pembelian
Breadcrumbs::for('Owner Pembelian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pembelian'],
    ])->first();
    $trail->push($menu->judul, route('Owner Pembelian'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Pembelian Create', function ($trail) {
    $trail->parent('Owner Pembelian');
    $trail->push('Tambah Data', route('Owner Pembelian Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Pembelian Show', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Owner Pembelian');
    $trail->push($data->no_faktur, route('Owner Pembelian Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Pembelian Edit', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Owner Pembelian Show', $data->id);
    $trail->push('Sunting Data', route('Owner Pembelian Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Pembelian Item Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Owner Pembelian Show', $data->id);
    $trail->push('Tambah Produk', route('Owner Pembelian Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Pembelian Pembayaran Create', function ($trail, $id) {
    $data = Pembelian::findOrFail($id);
    $trail->parent('Owner Pembelian Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Owner Pembelian Pembayaran Create', $data), ['icon' => '']);
});

// Penjualan
Breadcrumbs::for('Owner Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Penjualan'],
    ])->first();
    $trail->push($menu->judul, route('Owner Penjualan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Penjualan Create', function ($trail) {
    $trail->parent('Owner Penjualan');
    $trail->push('Tambah Data', route('Owner Penjualan Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Show', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Owner Penjualan');
    $trail->push($data->no_faktur, route('Owner Penjualan Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Edit', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Owner Penjualan Show', $data->id);
    $trail->push('Sunting Data', route('Owner Penjualan Edit', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Item Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Owner Penjualan Show', $data->id);
    $trail->push('Tambah Produk', route('Owner Penjualan Item Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Pembayaran Create', function ($trail, $id) {
    $data = Penjualan::findOrFail($id);
    $trail->parent('Owner Penjualan Show', $data->id);
    $trail->push('Tambah Pembayaran', route('Owner Penjualan Pembayaran Create', $data), ['icon' => '']);
});

// Pengaturan
Breadcrumbs::for('Owner Pengaturan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Pengaturan'],
    ])->first();
    $trail->push($menu->judul, route('Owner Pengaturan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Pengaturan Produk Kategori Create', function ($trail) {
    $trail->parent('Owner Pengaturan');
    $trail->push('Tambah Produk Kategori', route('Owner Pengaturan Produk Kategori Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Pengaturan Produk Kategori Edit', function ($trail, $id) {
    $data = Kategori::findOrFail($id);
    $trail->parent('Owner Pengaturan');
    $trail->push('Sunting Produk Kategori ' . $data->nama, route('Owner Pengaturan Produk Kategori Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Pengaturan Produk Satuan Create', function ($trail) {
    $trail->parent('Owner Pengaturan');
    $trail->push('Tambah Produk Satuan', route('Owner Pengaturan Produk Satuan Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Pengaturan Produk Satuan Edit', function ($trail, $id) {
    $data = Satuan::findOrFail($id);
    $trail->parent('Owner Pengaturan');
    $trail->push('Sunting Produk Satuan ' . $data->nama, route('Owner Pengaturan Produk Satuan Create', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Pengaturan Produk Jenis Koreksi Create', function ($trail) {
    $trail->parent('Owner Pengaturan');
    $trail->push('Tambah Produk Jenis Koreksi', route('Owner Pengaturan Produk Jenis Koreksi Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Pengaturan Produk Jenis Koreksi Edit', function ($trail, $id) {
    $data = JenisKoreksi::findOrFail($id);
    $trail->parent('Owner Pengaturan');
    $trail->push('Sunting Produk Jenis Koreksi ' . $data->nama, route('Owner Pengaturan Produk Jenis Koreksi Create', $data), ['icon' => '']);
});
