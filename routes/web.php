<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('login');
});

Route::get('keluar', function () {
    Auth::logout();
    return redirect('login');
})->name('Keluar');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('component')->group(function () {
        Route::post('/select/ajax-response', [App\Helpers\Form::class, 'component_select_ajax_response'])->name('Component Select Ajax Response');
    });

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('beranda')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Beranda::class, 'index'])->name('Admin Beranda');
            });

            Route::prefix('profil')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Profil::class, 'index'])->name('Admin Profil');
                Route::get('/sunting', [App\Http\Controllers\Admin\Profil::class, 'edit'])->name('Admin Profil Edit');
                Route::post('/sunting/action', [App\Http\Controllers\Admin\Profil::class, 'update'])->name('Admin Profil Update');
            });

            Route::prefix('produk')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Produk::class, 'index'])->name('Admin Produk');

                Route::group(['middleware' => ['permission:Menambah Produk']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Admin\Produk::class, 'create'])->name('Admin Produk Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Admin\Produk::class, 'store'])->name('Admin Produk Store');
                });

                Route::group(['middleware' => ['permission:Melihat Produk']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Produk::class, 'show'])->name('Admin Produk Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Produk']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Produk::class, 'edit'])->name('Admin Produk Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Produk::class, 'update'])->name('Admin Produk Update');

                    Route::get('/{id}/koreksi/tambah', [App\Http\Controllers\Admin\Produk::class, 'koreksi_create'])->name('Admin Produk Koreksi Create');
                    Route::post('/{id}/koreksi/tambah/action', [App\Http\Controllers\Admin\Produk::class, 'koreksi_store'])->name('Admin Produk Koreksi Store');
                    Route::post('/{id}/koreksi/hapus', [App\Http\Controllers\Admin\Produk::class, 'koreksi_destroy'])->name('Admin Produk Koreksi Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Produk']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Admin\Produk::class, 'destroy'])->name('Admin Produk Destroy');
                });
            });

            Route::prefix('customer')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Customer::class, 'index'])->name('Admin Customer');

                Route::group(['middleware' => ['permission:Menambah Customer']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Admin\Customer::class, 'create'])->name('Admin Customer Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Admin\Customer::class, 'store'])->name('Admin Customer Store');
                });

                Route::group(['middleware' => ['permission:Melihat Customer']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Customer::class, 'show'])->name('Admin Customer Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Customer']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Customer::class, 'edit'])->name('Admin Customer Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Customer::class, 'update'])->name('Admin Customer Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Customer']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Admin\Customer::class, 'destroy'])->name('Admin Customer Destroy');
                });
            });

            Route::prefix('supplier')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Supplier::class, 'index'])->name('Admin Supplier');

                Route::group(['middleware' => ['permission:Menambah Supplier']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Admin\Supplier::class, 'create'])->name('Admin Supplier Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Admin\Supplier::class, 'store'])->name('Admin Supplier Store');
                });

                Route::group(['middleware' => ['permission:Melihat Supplier']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Supplier::class, 'show'])->name('Admin Supplier Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Supplier']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Supplier::class, 'edit'])->name('Admin Supplier Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Supplier::class, 'update'])->name('Admin Supplier Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Supplier']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Admin\Supplier::class, 'destroy'])->name('Admin Supplier Destroy');
                });
            });

            Route::prefix('pembelian')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Pembelian::class, 'index'])->name('Admin Pembelian');
                Route::post('req', [App\Http\Controllers\Admin\Pembelian::class, 'req'])->name('Admin Pembelian Req');

                Route::group(['middleware' => ['permission:Menambah Pembelian']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Admin\Pembelian::class, 'create'])->name('Admin Pembelian Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Admin\Pembelian::class, 'store'])->name('Admin Pembelian Store');
                });

                Route::group(['middleware' => ['permission:Melihat Pembelian']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Pembelian::class, 'show'])->name('Admin Pembelian Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Pembelian']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Pembelian::class, 'edit'])->name('Admin Pembelian Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Pembelian::class, 'update'])->name('Admin Pembelian Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Admin\Pembelian::class, 'item_create'])->name('Admin Pembelian Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Admin\Pembelian::class, 'item_store'])->name('Admin Pembelian Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Admin\Pembelian::class, 'item_destroy'])->name('Admin Pembelian Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Admin\Pembelian::class, 'pembayaran_create'])->name('Admin Pembelian Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Admin\Pembelian::class, 'pembayaran_store'])->name('Admin Pembelian Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Admin\Pembelian::class, 'pembayaran_destroy'])->name('Admin Pembelian Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Pembelian']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Admin\Pembelian::class, 'destroy'])->name('Admin Pembelian Destroy');
                });
            });

            Route::prefix('penjualan')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Penjualan::class, 'index'])->name('Admin Penjualan');
                Route::post('req', [App\Http\Controllers\Admin\Penjualan::class, 'req'])->name('Admin Penjualan Req');

                Route::group(['middleware' => ['permission:Menambah Penjualan']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Admin\Penjualan::class, 'create'])->name('Admin Penjualan Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Admin\Penjualan::class, 'store'])->name('Admin Penjualan Store');
                });

                Route::group(['middleware' => ['permission:Melihat Penjualan']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Admin\Penjualan::class, 'show'])->name('Admin Penjualan Show');
                    Route::get('/{id}/faktur', [App\Http\Controllers\Admin\Penjualan::class, 'faktur'])->name('Admin Penjualan Faktur');
                    Route::get('/{id}/test', [App\Http\Controllers\Admin\Penjualan::class, 'test'])->name('test');
                });

                Route::group(['middleware' => ['permission:Mengubah Penjualan']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Penjualan::class, 'edit'])->name('Admin Penjualan Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Penjualan::class, 'update'])->name('Admin Penjualan Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Admin\Penjualan::class, 'item_create'])->name('Admin Penjualan Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Admin\Penjualan::class, 'item_store'])->name('Admin Penjualan Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Admin\Penjualan::class, 'item_destroy'])->name('Admin Penjualan Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Admin\Penjualan::class, 'pembayaran_create'])->name('Admin Penjualan Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Admin\Penjualan::class, 'pembayaran_store'])->name('Admin Penjualan Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Admin\Penjualan::class, 'pembayaran_destroy'])->name('Admin Penjualan Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Penjualan']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Admin\Penjualan::class, 'destroy'])->name('Admin Penjualan Destroy');
                });
            });

            Route::prefix('pengguna')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Pengguna::class, 'index'])->name('Admin Pengguna');
                Route::get('/tambah', [App\Http\Controllers\Admin\Pengguna::class, 'create'])->name('Admin Pengguna Create');
                Route::post('/tambah/action', [App\Http\Controllers\Admin\Pengguna::class, 'store'])->name('Admin Pengguna Store');
                Route::get('/{id}', [App\Http\Controllers\Admin\Pengguna::class, 'show'])->name('Admin Pengguna Show');
                Route::get('/{id}/sunting', [App\Http\Controllers\Admin\Pengguna::class, 'edit'])->name('Admin Pengguna Edit');
                Route::post('/{id}/sunting/action', [App\Http\Controllers\Admin\Pengguna::class, 'update'])->name('Admin Pengguna Update');
                Route::post('/hapus', [App\Http\Controllers\Admin\Pengguna::class, 'destroy'])->name('Admin Pengguna Destroy');
            });

            Route::prefix('pengaturan')->group(function () {
                Route::get('', [App\Http\Controllers\Admin\Pengaturan::class, 'index'])->name('Admin Pengaturan');
                Route::get('izin-level-akses/{id}/sunting', [App\Http\Controllers\Admin\Pengaturan::class, 'edit_izin_level_akses'])->name('Admin Pengaturan Izin Level Akses Edit');
                Route::post('izin-level-akses/{id}/sunting/action', [App\Http\Controllers\Admin\Pengaturan::class, 'update_izin_level_akses'])->name('Admin Pengaturan Izin Level Akses Update');
                Route::get('produk-kategori/tambah', [App\Http\Controllers\Admin\Pengaturan::class, 'create_produk_kategori'])->name('Admin Pengaturan Produk Kategori Create');
                Route::post('produk-kategori/tambah/action', [App\Http\Controllers\Admin\Pengaturan::class, 'store_produk_kategori'])->name('Admin Pengaturan Produk Kategori Store');
                Route::get('produk-kategori/{id}/sunting', [App\Http\Controllers\Admin\Pengaturan::class, 'edit_produk_kategori'])->name('Admin Pengaturan Produk Kategori Edit');
                Route::post('produk-kategori/{id}/sunting/action', [App\Http\Controllers\Admin\Pengaturan::class, 'update_produk_kategori'])->name('Admin Pengaturan Produk Kategori Update');
                Route::post('produk-kategori/hapus', [App\Http\Controllers\Admin\Pengaturan::class, 'destroy_produk_kategori'])->name('Admin Pengaturan Produk Kategori Destroy');
                Route::get('produk-satuan/tambah', [App\Http\Controllers\Admin\Pengaturan::class, 'create_produk_satuan'])->name('Admin Pengaturan Produk Satuan Create');
                Route::post('produk-satuan/tambah/action', [App\Http\Controllers\Admin\Pengaturan::class, 'store_produk_satuan'])->name('Admin Pengaturan Produk Satuan Store');
                Route::get('produk-satuan/{id}/sunting', [App\Http\Controllers\Admin\Pengaturan::class, 'edit_produk_satuan'])->name('Admin Pengaturan Produk Satuan Edit');
                Route::post('produk-satuan/{id}/sunting/action', [App\Http\Controllers\Admin\Pengaturan::class, 'update_produk_satuan'])->name('Admin Pengaturan Produk Satuan Update');
                Route::post('produk-satuan/hapus', [App\Http\Controllers\Admin\Pengaturan::class, 'destroy_produk_satuan'])->name('Admin Pengaturan Produk Satuan Destroy');
                Route::get('produk-jenis-koreksi/tambah', [App\Http\Controllers\Admin\Pengaturan::class, 'create_produk_jenis_koreksi'])->name('Admin Pengaturan Produk Jenis Koreksi Create');
                Route::post('produk-jenis-koreksi/tambah/action', [App\Http\Controllers\Admin\Pengaturan::class, 'store_produk_jenis_koreksi'])->name('Admin Pengaturan Produk Jenis Koreksi Store');
                Route::get('produk-jenis-koreksi/{id}/sunting', [App\Http\Controllers\Admin\Pengaturan::class, 'edit_produk_jenis_koreksi'])->name('Admin Pengaturan Produk Jenis Koreksi Edit');
                Route::post('produk-jenis-koreksi/{id}/sunting/action', [App\Http\Controllers\Admin\Pengaturan::class, 'update_produk_jenis_koreksi'])->name('Admin Pengaturan Produk Jenis Koreksi Update');
                Route::post('produk-jenis-koreksi/hapus', [App\Http\Controllers\Admin\Pengaturan::class, 'destroy_produk_jenis_koreksi'])->name('Admin Pengaturan Produk Jenis Koreksi Destroy');
            });

            Route::prefix('tabel')->group(function () {
                Route::get('produk', [App\Http\Controllers\Admin\Produk::class, 'dt'])->name('Admin Tabel Produk');
                Route::get('produk/{id}/koreksi', [App\Http\Controllers\Admin\Produk::class, 'dt_koreksi'])->name('Admin Tabel Produk Koreksi');
                Route::get('customer', [App\Http\Controllers\Admin\Customer::class, 'dt'])->name('Admin Tabel Customer');
                Route::get('supplier', [App\Http\Controllers\Admin\Supplier::class, 'dt'])->name('Admin Tabel Supplier');
                Route::get('pembelian', [App\Http\Controllers\Admin\Pembelian::class, 'dt'])->name('Admin Tabel Pembelian');
                Route::get('pembelian/{id}/item', [App\Http\Controllers\Admin\Pembelian::class, 'dt_item'])->name('Admin Tabel Pembelian Item');
                Route::get('pembelian/{id}/pembayaran', [App\Http\Controllers\Admin\Pembelian::class, 'dt_pembayaran'])->name('Admin Tabel Pembelian Pembayaran');
                Route::get('penjualan', [App\Http\Controllers\Admin\Penjualan::class, 'dt'])->name('Admin Tabel Penjualan');
                Route::get('penjualan/{id}/item', [App\Http\Controllers\Admin\Penjualan::class, 'dt_item'])->name('Admin Tabel Penjualan Item');
                Route::get('penjualan/{id}/pembayaran', [App\Http\Controllers\Admin\Penjualan::class, 'dt_pembayaran'])->name('Admin Tabel Penjualan Pembayaran');
                Route::get('pengguna', [App\Http\Controllers\Admin\Pengguna::class, 'dt'])->name('Admin Tabel Pengguna');
                Route::get('pengaturan/izin-level-akses', [App\Http\Controllers\Admin\Pengaturan::class, 'dt_izin_level_akses'])->name('Admin Tabel Pengaturan Izin Level Akses');
                Route::get('pengaturan/produk-satuan', [App\Http\Controllers\Admin\Pengaturan::class, 'dt_produk_satuan'])->name('Admin Tabel Pengaturan Produk Satuan');
                Route::get('pengaturan/produk-kategori', [App\Http\Controllers\Admin\Pengaturan::class, 'dt_produk_kategori'])->name('Admin Tabel Pengaturan Produk Kategori');
                Route::get('pengaturan/produk-jenis-koreksi', [App\Http\Controllers\Admin\Pengaturan::class, 'dt_produk_jenis_koreksi'])->name('Admin Tabel Pengaturan Produk Jenis Koreksi');
            });
        });
    });

    Route::group(['middleware' => ['role:Kasir']], function () {
        Route::prefix('kasir')->group(function () {
            Route::prefix('beranda')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Beranda::class, 'index'])->name('Kasir Beranda');
            });

            Route::prefix('profil')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Profil::class, 'index'])->name('Kasir Profil');
                Route::get('/sunting', [App\Http\Controllers\Kasir\Profil::class, 'edit'])->name('Kasir Profil Edit');
                Route::post('/sunting/action', [App\Http\Controllers\Kasir\Profil::class, 'update'])->name('Kasir Profil Update');
            });

            Route::prefix('produk')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Produk::class, 'index'])->name('Kasir Produk');

                Route::group(['middleware' => ['permission:Menambah Produk']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Kasir\Produk::class, 'create'])->name('Kasir Produk Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Kasir\Produk::class, 'store'])->name('Kasir Produk Store');
                });

                Route::group(['middleware' => ['permission:Melihat Produk']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Kasir\Produk::class, 'show'])->name('Kasir Produk Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Produk']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Kasir\Produk::class, 'edit'])->name('Kasir Produk Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Kasir\Produk::class, 'update'])->name('Kasir Produk Update');

                    Route::get('/{id}/koreksi/tambah', [App\Http\Controllers\Kasir\Produk::class, 'koreksi_create'])->name('Kasir Produk Koreksi Create');
                    Route::post('/{id}/koreksi/tambah/action', [App\Http\Controllers\Kasir\Produk::class, 'koreksi_store'])->name('Kasir Produk Koreksi Store');
                    Route::post('/{id}/koreksi/hapus', [App\Http\Controllers\Kasir\Produk::class, 'koreksi_destroy'])->name('Kasir Produk Koreksi Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Produk']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Kasir\Produk::class, 'destroy'])->name('Kasir Produk Destroy');
                });
            });

            Route::prefix('customer')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Customer::class, 'index'])->name('Kasir Customer');

                Route::group(['middleware' => ['permission:Menambah Customer']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Kasir\Customer::class, 'create'])->name('Kasir Customer Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Kasir\Customer::class, 'store'])->name('Kasir Customer Store');
                });

                Route::group(['middleware' => ['permission:Melihat Customer']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Kasir\Customer::class, 'show'])->name('Kasir Customer Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Customer']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Kasir\Customer::class, 'edit'])->name('Kasir Customer Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Kasir\Customer::class, 'update'])->name('Kasir Customer Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Customer']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Kasir\Customer::class, 'destroy'])->name('Kasir Customer Destroy');
                });
            });

            Route::prefix('supplier')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Supplier::class, 'index'])->name('Kasir Supplier');

                Route::group(['middleware' => ['permission:Menambah Supplier']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Kasir\Supplier::class, 'create'])->name('Kasir Supplier Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Kasir\Supplier::class, 'store'])->name('Kasir Supplier Store');
                });

                Route::group(['middleware' => ['permission:Melihat Supplier']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Kasir\Supplier::class, 'show'])->name('Kasir Supplier Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Supplier']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Kasir\Supplier::class, 'edit'])->name('Kasir Supplier Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Kasir\Supplier::class, 'update'])->name('Kasir Supplier Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Supplier']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Kasir\Supplier::class, 'destroy'])->name('Kasir Supplier Destroy');
                });
            });

            Route::prefix('pembelian')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Pembelian::class, 'index'])->name('Kasir Pembelian');
                Route::post('req', [App\Http\Controllers\Kasir\Pembelian::class, 'req'])->name('Kasir Pembelian Req');

                Route::group(['middleware' => ['permission:Menambah Pembelian']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Kasir\Pembelian::class, 'create'])->name('Kasir Pembelian Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Kasir\Pembelian::class, 'store'])->name('Kasir Pembelian Store');
                });

                Route::group(['middleware' => ['permission:Melihat Pembelian']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Kasir\Pembelian::class, 'show'])->name('Kasir Pembelian Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Pembelian']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Kasir\Pembelian::class, 'edit'])->name('Kasir Pembelian Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Kasir\Pembelian::class, 'update'])->name('Kasir Pembelian Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Kasir\Pembelian::class, 'item_create'])->name('Kasir Pembelian Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Kasir\Pembelian::class, 'item_store'])->name('Kasir Pembelian Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Kasir\Pembelian::class, 'item_destroy'])->name('Kasir Pembelian Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Kasir\Pembelian::class, 'pembayaran_create'])->name('Kasir Pembelian Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Kasir\Pembelian::class, 'pembayaran_store'])->name('Kasir Pembelian Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Kasir\Pembelian::class, 'pembayaran_destroy'])->name('Kasir Pembelian Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Pembelian']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Kasir\Pembelian::class, 'destroy'])->name('Kasir Pembelian Destroy');
                });
            });

            Route::prefix('penjualan')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Penjualan::class, 'index'])->name('Kasir Penjualan');
                Route::post('req', [App\Http\Controllers\Kasir\Penjualan::class, 'req'])->name('Kasir Penjualan Req');

                Route::group(['middleware' => ['permission:Menambah Penjualan']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Kasir\Penjualan::class, 'create'])->name('Kasir Penjualan Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Kasir\Penjualan::class, 'store'])->name('Kasir Penjualan Store');
                });

                Route::group(['middleware' => ['permission:Melihat Penjualan']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Kasir\Penjualan::class, 'show'])->name('Kasir Penjualan Show');
                    Route::get('/{id}/faktur', [App\Http\Controllers\Kasir\Penjualan::class, 'faktur'])->name('Kasir Penjualan Faktur');
                });

                Route::group(['middleware' => ['permission:Mengubah Penjualan']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Kasir\Penjualan::class, 'edit'])->name('Kasir Penjualan Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Kasir\Penjualan::class, 'update'])->name('Kasir Penjualan Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Kasir\Penjualan::class, 'item_create'])->name('Kasir Penjualan Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Kasir\Penjualan::class, 'item_store'])->name('Kasir Penjualan Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Kasir\Penjualan::class, 'item_destroy'])->name('Kasir Penjualan Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Kasir\Penjualan::class, 'pembayaran_create'])->name('Kasir Penjualan Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Kasir\Penjualan::class, 'pembayaran_store'])->name('Kasir Penjualan Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Kasir\Penjualan::class, 'pembayaran_destroy'])->name('Kasir Penjualan Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Penjualan']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Kasir\Penjualan::class, 'destroy'])->name('Kasir Penjualan Destroy');
                });
            });

            Route::prefix('pengaturan')->group(function () {
                Route::get('', [App\Http\Controllers\Kasir\Pengaturan::class, 'index'])->name('Kasir Pengaturan');
                Route::get('produk-kategori/tambah', [App\Http\Controllers\Kasir\Pengaturan::class, 'create_produk_kategori'])->name('Kasir Pengaturan Produk Kategori Create');
                Route::post('produk-kategori/tambah/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'store_produk_kategori'])->name('Kasir Pengaturan Produk Kategori Store');
                Route::get('produk-kategori/{id}/sunting', [App\Http\Controllers\Kasir\Pengaturan::class, 'edit_produk_kategori'])->name('Kasir Pengaturan Produk Kategori Edit');
                Route::post('produk-kategori/{id}/sunting/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'update_produk_kategori'])->name('Kasir Pengaturan Produk Kategori Update');
                Route::post('produk-kategori/hapus', [App\Http\Controllers\Kasir\Pengaturan::class, 'destroy_produk_kategori'])->name('Kasir Pengaturan Produk Kategori Destroy');
                Route::get('produk-satuan/tambah', [App\Http\Controllers\Kasir\Pengaturan::class, 'create_produk_satuan'])->name('Kasir Pengaturan Produk Satuan Create');
                Route::post('produk-satuan/tambah/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'store_produk_satuan'])->name('Kasir Pengaturan Produk Satuan Store');
                Route::get('produk-satuan/{id}/sunting', [App\Http\Controllers\Kasir\Pengaturan::class, 'edit_produk_satuan'])->name('Kasir Pengaturan Produk Satuan Edit');
                Route::post('produk-satuan/{id}/sunting/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'update_produk_satuan'])->name('Kasir Pengaturan Produk Satuan Update');
                Route::post('produk-satuan/hapus', [App\Http\Controllers\Kasir\Pengaturan::class, 'destroy_produk_satuan'])->name('Kasir Pengaturan Produk Satuan Destroy');
                Route::get('produk-jenis-koreksi/tambah', [App\Http\Controllers\Kasir\Pengaturan::class, 'create_produk_jenis_koreksi'])->name('Kasir Pengaturan Produk Jenis Koreksi Create');
                Route::post('produk-jenis-koreksi/tambah/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'store_produk_jenis_koreksi'])->name('Kasir Pengaturan Produk Jenis Koreksi Store');
                Route::get('produk-jenis-koreksi/{id}/sunting', [App\Http\Controllers\Kasir\Pengaturan::class, 'edit_produk_jenis_koreksi'])->name('Kasir Pengaturan Produk Jenis Koreksi Edit');
                Route::post('produk-jenis-koreksi/{id}/sunting/action', [App\Http\Controllers\Kasir\Pengaturan::class, 'update_produk_jenis_koreksi'])->name('Kasir Pengaturan Produk Jenis Koreksi Update');
                Route::post('produk-jenis-koreksi/hapus', [App\Http\Controllers\Kasir\Pengaturan::class, 'destroy_produk_jenis_koreksi'])->name('Kasir Pengaturan Produk Jenis Koreksi Destroy');
            });

            Route::prefix('tabel')->group(function () {
                Route::get('produk', [App\Http\Controllers\Kasir\Produk::class, 'dt'])->name('Kasir Tabel Produk');
                Route::get('produk/{id}/koreksi', [App\Http\Controllers\Kasir\Produk::class, 'dt_koreksi'])->name('Kasir Tabel Produk Koreksi');
                Route::get('customer', [App\Http\Controllers\Kasir\Customer::class, 'dt'])->name('Kasir Tabel Customer');
                Route::get('supplier', [App\Http\Controllers\Kasir\Supplier::class, 'dt'])->name('Kasir Tabel Supplier');
                Route::get('pembelian', [App\Http\Controllers\Kasir\Pembelian::class, 'dt'])->name('Kasir Tabel Pembelian');
                Route::get('pembelian/{id}/item', [App\Http\Controllers\Kasir\Pembelian::class, 'dt_item'])->name('Kasir Tabel Pembelian Item');
                Route::get('pembelian/{id}/pembayaran', [App\Http\Controllers\Kasir\Pembelian::class, 'dt_pembayaran'])->name('Kasir Tabel Pembelian Pembayaran');
                Route::get('penjualan', [App\Http\Controllers\Kasir\Penjualan::class, 'dt'])->name('Kasir Tabel Penjualan');
                Route::get('penjualan/{id}/item', [App\Http\Controllers\Kasir\Penjualan::class, 'dt_item'])->name('Kasir Tabel Penjualan Item');
                Route::get('penjualan/{id}/pembayaran', [App\Http\Controllers\Kasir\Penjualan::class, 'dt_pembayaran'])->name('Kasir Tabel Penjualan Pembayaran');
                Route::get('pengaturan/produk-satuan', [App\Http\Controllers\Kasir\Pengaturan::class, 'dt_produk_satuan'])->name('Kasir Tabel Pengaturan Produk Satuan');
                Route::get('pengaturan/produk-kategori', [App\Http\Controllers\Kasir\Pengaturan::class, 'dt_produk_kategori'])->name('Kasir Tabel Pengaturan Produk Kategori');
                Route::get('pengaturan/produk-jenis-koreksi', [App\Http\Controllers\Kasir\Pengaturan::class, 'dt_produk_jenis_koreksi'])->name('Kasir Tabel Pengaturan Produk Jenis Koreksi');
            });
        });
    });

    Route::group(['middleware' => ['role:Owner']], function () {
        Route::prefix('owner')->group(function () {
            Route::prefix('beranda')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Beranda::class, 'index'])->name('Owner Beranda');
            });

            Route::prefix('profil')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Profil::class, 'index'])->name('Owner Profil');
                Route::get('/sunting', [App\Http\Controllers\Owner\Profil::class, 'edit'])->name('Owner Profil Edit');
                Route::post('/sunting/action', [App\Http\Controllers\Owner\Profil::class, 'update'])->name('Owner Profil Update');
            });

            Route::prefix('produk')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Produk::class, 'index'])->name('Owner Produk');

                Route::group(['middleware' => ['permission:Menambah Produk']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Owner\Produk::class, 'create'])->name('Owner Produk Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Owner\Produk::class, 'store'])->name('Owner Produk Store');
                });

                Route::group(['middleware' => ['permission:Melihat Produk']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Owner\Produk::class, 'show'])->name('Owner Produk Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Produk']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Produk::class, 'edit'])->name('Owner Produk Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Produk::class, 'update'])->name('Owner Produk Update');

                    Route::get('/{id}/koreksi/tambah', [App\Http\Controllers\Owner\Produk::class, 'koreksi_create'])->name('Owner Produk Koreksi Create');
                    Route::post('/{id}/koreksi/tambah/action', [App\Http\Controllers\Owner\Produk::class, 'koreksi_store'])->name('Owner Produk Koreksi Store');
                    Route::post('/{id}/koreksi/hapus', [App\Http\Controllers\Owner\Produk::class, 'koreksi_destroy'])->name('Owner Produk Koreksi Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Produk']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Owner\Produk::class, 'destroy'])->name('Owner Produk Destroy');
                });
            });

            Route::prefix('customer')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Customer::class, 'index'])->name('Owner Customer');

                Route::group(['middleware' => ['permission:Menambah Customer']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Owner\Customer::class, 'create'])->name('Owner Customer Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Owner\Customer::class, 'store'])->name('Owner Customer Store');
                });

                Route::group(['middleware' => ['permission:Melihat Customer']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Owner\Customer::class, 'show'])->name('Owner Customer Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Customer']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Customer::class, 'edit'])->name('Owner Customer Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Customer::class, 'update'])->name('Owner Customer Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Customer']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Owner\Customer::class, 'destroy'])->name('Owner Customer Destroy');
                });
            });

            Route::prefix('supplier')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Supplier::class, 'index'])->name('Owner Supplier');

                Route::group(['middleware' => ['permission:Menambah Supplier']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Owner\Supplier::class, 'create'])->name('Owner Supplier Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Owner\Supplier::class, 'store'])->name('Owner Supplier Store');
                });

                Route::group(['middleware' => ['permission:Melihat Supplier']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Owner\Supplier::class, 'show'])->name('Owner Supplier Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Supplier']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Supplier::class, 'edit'])->name('Owner Supplier Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Supplier::class, 'update'])->name('Owner Supplier Update');
                });

                Route::group(['middleware' => ['permission:Menghapus Supplier']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Owner\Supplier::class, 'destroy'])->name('Owner Supplier Destroy');
                });
            });

            Route::prefix('laporan-pembelian')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\LaporanPembelian::class, 'index'])->name('Owner Laporan Pembelian');
                Route::post('/proses', [App\Http\Controllers\Owner\LaporanPembelian::class, 'proses'])->name('Owner Laporan Pembelian Proses');
                Route::get('/cetak', [App\Http\Controllers\Owner\LaporanPembelian::class, 'cetak'])->name('Owner Laporan Pembelian Cetak');
            });

            Route::prefix('laporan-penjualan')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\LaporanPenjualan::class, 'index'])->name('Owner Laporan Penjualan');
                Route::post('/proses', [App\Http\Controllers\Owner\LaporanPenjualan::class, 'proses'])->name('Owner Laporan Penjualan Proses');
                Route::get('/cetak', [App\Http\Controllers\Owner\LaporanPenjualan::class, 'cetak'])->name('Owner Laporan Penjualan Cetak');
            });

            Route::prefix('laporan-utang')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\LaporanUtang::class, 'index'])->name('Owner Laporan Utang');
                Route::post('/proses', [App\Http\Controllers\Owner\LaporanUtang::class, 'proses'])->name('Owner Laporan Utang Proses');
                Route::get('/cetak', [App\Http\Controllers\Owner\LaporanUtang::class, 'cetak'])->name('Owner Laporan Utang Cetak');
            });

            Route::prefix('pembelian')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Pembelian::class, 'index'])->name('Owner Pembelian');
                Route::post('req', [App\Http\Controllers\Owner\Pembelian::class, 'req'])->name('Owner Pembelian Req');

                Route::group(['middleware' => ['permission:Menambah Pembelian']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Owner\Pembelian::class, 'create'])->name('Owner Pembelian Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Owner\Pembelian::class, 'store'])->name('Owner Pembelian Store');
                });

                Route::group(['middleware' => ['permission:Melihat Pembelian']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Owner\Pembelian::class, 'show'])->name('Owner Pembelian Show');
                });

                Route::group(['middleware' => ['permission:Mengubah Pembelian']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Pembelian::class, 'edit'])->name('Owner Pembelian Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Pembelian::class, 'update'])->name('Owner Pembelian Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Owner\Pembelian::class, 'item_create'])->name('Owner Pembelian Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Owner\Pembelian::class, 'item_store'])->name('Owner Pembelian Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Owner\Pembelian::class, 'item_destroy'])->name('Owner Pembelian Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Owner\Pembelian::class, 'pembayaran_create'])->name('Owner Pembelian Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Owner\Pembelian::class, 'pembayaran_store'])->name('Owner Pembelian Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Owner\Pembelian::class, 'pembayaran_destroy'])->name('Owner Pembelian Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Pembelian']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Owner\Pembelian::class, 'destroy'])->name('Owner Pembelian Destroy');
                });
            });

            Route::prefix('penjualan')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Penjualan::class, 'index'])->name('Owner Penjualan');
                Route::post('req', [App\Http\Controllers\Owner\Penjualan::class, 'req'])->name('Owner Penjualan Req');

                Route::group(['middleware' => ['permission:Menambah Penjualan']], function () {
                    Route::get('/tambah', [App\Http\Controllers\Owner\Penjualan::class, 'create'])->name('Owner Penjualan Create');
                    Route::post('/tambah/action', [App\Http\Controllers\Owner\Penjualan::class, 'store'])->name('Owner Penjualan Store');
                });

                Route::group(['middleware' => ['permission:Melihat Penjualan']], function () {
                    Route::get('/{id}', [App\Http\Controllers\Owner\Penjualan::class, 'show'])->name('Owner Penjualan Show');
                    Route::get('/{id}/faktur', [App\Http\Controllers\Owner\Penjualan::class, 'faktur'])->name('Owner Penjualan Faktur');
                });

                Route::group(['middleware' => ['permission:Mengubah Penjualan']], function () {
                    Route::get('/{id}/sunting', [App\Http\Controllers\Owner\Penjualan::class, 'edit'])->name('Owner Penjualan Edit');
                    Route::post('/{id}/sunting/action', [App\Http\Controllers\Owner\Penjualan::class, 'update'])->name('Owner Penjualan Update');

                    Route::get('/{id}/item/tambah', [App\Http\Controllers\Owner\Penjualan::class, 'item_create'])->name('Owner Penjualan Item Create');
                    Route::post('/{id}/item/tambah/action', [App\Http\Controllers\Owner\Penjualan::class, 'item_store'])->name('Owner Penjualan Item Store');
                    Route::post('/{id}/item/hapus', [App\Http\Controllers\Owner\Penjualan::class, 'item_destroy'])->name('Owner Penjualan Item Destroy');

                    Route::get('/{id}/pembayaran/tambah', [App\Http\Controllers\Owner\Penjualan::class, 'pembayaran_create'])->name('Owner Penjualan Pembayaran Create');
                    Route::post('/{id}/pembayaran/tambah/action', [App\Http\Controllers\Owner\Penjualan::class, 'pembayaran_store'])->name('Owner Penjualan Pembayaran Store');
                    Route::post('/{id}/pembayaran/hapus', [App\Http\Controllers\Owner\Penjualan::class, 'pembayaran_destroy'])->name('Owner Penjualan Pembayaran Destroy');
                });

                Route::group(['middleware' => ['permission:Menghapus Penjualan']], function () {
                    Route::post('/hapus', [App\Http\Controllers\Owner\Penjualan::class, 'destroy'])->name('Owner Penjualan Destroy');
                });
            });

            Route::prefix('pengaturan')->group(function () {
                Route::get('', [App\Http\Controllers\Owner\Pengaturan::class, 'index'])->name('Owner Pengaturan');
                Route::get('produk-kategori/tambah', [App\Http\Controllers\Owner\Pengaturan::class, 'create_produk_kategori'])->name('Owner Pengaturan Produk Kategori Create');
                Route::post('produk-kategori/tambah/action', [App\Http\Controllers\Owner\Pengaturan::class, 'store_produk_kategori'])->name('Owner Pengaturan Produk Kategori Store');
                Route::get('produk-kategori/{id}/sunting', [App\Http\Controllers\Owner\Pengaturan::class, 'edit_produk_kategori'])->name('Owner Pengaturan Produk Kategori Edit');
                Route::post('produk-kategori/{id}/sunting/action', [App\Http\Controllers\Owner\Pengaturan::class, 'update_produk_kategori'])->name('Owner Pengaturan Produk Kategori Update');
                Route::post('produk-kategori/hapus', [App\Http\Controllers\Owner\Pengaturan::class, 'destroy_produk_kategori'])->name('Owner Pengaturan Produk Kategori Destroy');
                Route::get('produk-satuan/tambah', [App\Http\Controllers\Owner\Pengaturan::class, 'create_produk_satuan'])->name('Owner Pengaturan Produk Satuan Create');
                Route::post('produk-satuan/tambah/action', [App\Http\Controllers\Owner\Pengaturan::class, 'store_produk_satuan'])->name('Owner Pengaturan Produk Satuan Store');
                Route::get('produk-satuan/{id}/sunting', [App\Http\Controllers\Owner\Pengaturan::class, 'edit_produk_satuan'])->name('Owner Pengaturan Produk Satuan Edit');
                Route::post('produk-satuan/{id}/sunting/action', [App\Http\Controllers\Owner\Pengaturan::class, 'update_produk_satuan'])->name('Owner Pengaturan Produk Satuan Update');
                Route::post('produk-satuan/hapus', [App\Http\Controllers\Owner\Pengaturan::class, 'destroy_produk_satuan'])->name('Owner Pengaturan Produk Satuan Destroy');
                Route::get('produk-jenis-koreksi/tambah', [App\Http\Controllers\Owner\Pengaturan::class, 'create_produk_jenis_koreksi'])->name('Owner Pengaturan Produk Jenis Koreksi Create');
                Route::post('produk-jenis-koreksi/tambah/action', [App\Http\Controllers\Owner\Pengaturan::class, 'store_produk_jenis_koreksi'])->name('Owner Pengaturan Produk Jenis Koreksi Store');
                Route::get('produk-jenis-koreksi/{id}/sunting', [App\Http\Controllers\Owner\Pengaturan::class, 'edit_produk_jenis_koreksi'])->name('Owner Pengaturan Produk Jenis Koreksi Edit');
                Route::post('produk-jenis-koreksi/{id}/sunting/action', [App\Http\Controllers\Owner\Pengaturan::class, 'update_produk_jenis_koreksi'])->name('Owner Pengaturan Produk Jenis Koreksi Update');
                Route::post('produk-jenis-koreksi/hapus', [App\Http\Controllers\Owner\Pengaturan::class, 'destroy_produk_jenis_koreksi'])->name('Owner Pengaturan Produk Jenis Koreksi Destroy');
            });

            Route::prefix('tabel')->group(function () {
                Route::get('produk', [App\Http\Controllers\Owner\Produk::class, 'dt'])->name('Owner Tabel Produk');
                Route::get('produk/{id}/koreksi', [App\Http\Controllers\Owner\Produk::class, 'dt_koreksi'])->name('Owner Tabel Produk Koreksi');
                Route::get('customer', [App\Http\Controllers\Owner\Customer::class, 'dt'])->name('Owner Tabel Customer');
                Route::get('supplier', [App\Http\Controllers\Owner\Supplier::class, 'dt'])->name('Owner Tabel Supplier');
                Route::get('pembelian', [App\Http\Controllers\Owner\Pembelian::class, 'dt'])->name('Owner Tabel Pembelian');
                Route::get('pembelian/{id}/item', [App\Http\Controllers\Owner\Pembelian::class, 'dt_item'])->name('Owner Tabel Pembelian Item');
                Route::get('pembelian/{id}/pembayaran', [App\Http\Controllers\Owner\Pembelian::class, 'dt_pembayaran'])->name('Owner Tabel Pembelian Pembayaran');
                Route::get('penjualan', [App\Http\Controllers\Owner\Penjualan::class, 'dt'])->name('Owner Tabel Penjualan');
                Route::get('penjualan/{id}/item', [App\Http\Controllers\Owner\Penjualan::class, 'dt_item'])->name('Owner Tabel Penjualan Item');
                Route::get('penjualan/{id}/pembayaran', [App\Http\Controllers\Owner\Penjualan::class, 'dt_pembayaran'])->name('Owner Tabel Penjualan Pembayaran');
                Route::get('pengaturan/produk-satuan', [App\Http\Controllers\Owner\Pengaturan::class, 'dt_produk_satuan'])->name('Owner Tabel Pengaturan Produk Satuan');
                Route::get('pengaturan/produk-kategori', [App\Http\Controllers\Owner\Pengaturan::class, 'dt_produk_kategori'])->name('Owner Tabel Pengaturan Produk Kategori');
                Route::get('pengaturan/produk-jenis-koreksi', [App\Http\Controllers\Owner\Pengaturan::class, 'dt_produk_jenis_koreksi'])->name('Owner Tabel Pengaturan Produk Jenis Koreksi');
            });
        });
    });
});
