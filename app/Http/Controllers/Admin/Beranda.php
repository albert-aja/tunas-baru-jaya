<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Produk;

class Beranda extends Controller
{
    public function index()
    {
        $total_customer = Customer::count();
        $total_produk = Produk::count();
        $total_pembelian = Pembelian::count();
        $total_penjualan = Penjualan::count();

        return view('admin.beranda.index', compact('total_customer', 'total_produk', 'total_pembelian', 'total_penjualan'));
    }
}
