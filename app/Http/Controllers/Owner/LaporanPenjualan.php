<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class LaporanPenjualan extends Controller
{
    public function index()
    {
        return view('owner.laporan-penjualan.index');
    }

    public function proses(Request $request)
    {
        $datas = Penjualan::orderBy('waktu_transaksi')->get();
        $new_data = [];

        foreach ($datas as $data) {
            $waktu = 1;
            $harga = 1;
            $pembayaran = 1;
            $jenis_penjualan = 1;

            if (!is_null($request->waktu_transaksi_awal) and !is_null($request->waktu_transaksi_akhir)) {
                if ($request->waktu_transaksi_awal <= $data->waktu_transaksi and $data->waktu_transaksi <= $request->waktu_transaksi_akhir) {
                    $waktu = 1;
                } else {
                    $waktu = 0;
                }
            }

            if (!is_null($request->total_penjualan_minimal) and !is_null($request->total_penjualan_maksimal)) {
                if ($request->total_penjualan_minimal <= $data->get_total_harga() and $data->get_total_harga() <= $request->total_penjualan_maksimal) {
                    $harga = 1;
                } else {
                    $harga = 0;
                }
            }

            if (!is_null($request->total_pembayaran_minimal) and !is_null($request->total_pembayaran_maksimal)) {
                if ($request->total_pembayaran_minimal <= $data->get_total_pembayaran() and $data->get_total_pembayaran() <= $request->total_pembayaran_maksimal) {
                    $pembayaran = 1;
                } else {
                    $pembayaran = 0;
                }
            }

            if (!is_null($request->jenis_penjualan)) {
                if ($request->jenis_penjualan == 'distributor') {
                    if ($data->customer != '') {
                        $jenis_penjualan = 1;
                    } else {
                        $jenis_penjualan = 0;
                    }
                } else if ($request->jenis_penjualan == 'eceran') {
                    if ($data->customer == '') {
                        $jenis_penjualan = 1;
                    } else {
                        $jenis_penjualan = 0;
                    }
                }
            }

            if ($waktu == 1 and $harga == 1 and $pembayaran == 1 and $jenis_penjualan == 1) {
                array_push($new_data, $data);
            }
        }

        $filter = [
            'jenis_penjualan' => $request->jenis_penjualan,
            'waktu_transaksi_awal' => $request->waktu_transaksi_awal,
            'waktu_transaksi_akhir' => $request->waktu_transaksi_akhir,
            'total_penjualan_minimal' => $request->total_penjualan_minimal,
            'total_penjualan_maksimal' => $request->total_penjualan_maksimal,
            'total_pembayaran_minimal' => $request->total_pembayaran_minimal,
            'total_pembayaran_maksimal' => $request->total_pembayaran_maksimal,
        ];

        session()->put('laporan_penjualan', $new_data);
        session()->put('laporan_penjualan_filter', $filter);
        $return = array('status' => 'Valid');
        echo json_encode($return);
    }

    public function cetak()
    {
        $data = session()->get('laporan_penjualan');
        $filter = session()->get('laporan_penjualan_filter');
        session()->forget('laporan_penjualan');
        session()->forget('laporan_penjualan_filter');
        $pdf = PDF::loadView('owner.laporan-penjualan.cetak', compact('data', 'filter'));
        return $pdf->stream('Laporan-Penjualan.pdf');
    }
}
