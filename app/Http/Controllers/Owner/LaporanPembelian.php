<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanPembelian extends Controller
{
    public function index()
    {
        return view('owner.laporan-pembelian.index');
    }

    public function proses(Request $request)
    {
        $datas = Pembelian::orderBy('waktu_transaksi')->get();
        $new_data = [];

        foreach ($datas as $data) {
            $waktu = 1;
            $harga = 1;
            $pembayaran = 1;
            $supplier = 1;

            if (!is_null($request->supplier)) {
                if ($request->supplier == $data->supplier) {
                    $waktu = 1;
                } else {
                    $waktu = 0;
                }
            }

            if (!is_null($request->waktu_transaksi_awal) and !is_null($request->waktu_transaksi_akhir)) {
                if ($request->waktu_transaksi_awal <= $data->waktu_transaksi and $data->waktu_transaksi <= $request->waktu_transaksi_akhir) {
                    $waktu = 1;
                } else {
                    $waktu = 0;
                }
            }

            if (!is_null($request->total_pembelian_minimal) and !is_null($request->total_pembelian_maksimal)) {
                if ($request->total_pembelian_minimal <= $data->get_total_harga() and $data->get_total_harga() <= $request->total_pembelian_maksimal) {
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

            if ($waktu == 1 and $harga == 1 and $pembayaran == 1 and $supplier == 1) {
                array_push($new_data, $data);
            }
        }

        $filter = [
            'waktu_transaksi_awal' => $request->waktu_transaksi_awal,
            'waktu_transaksi_akhir' => $request->waktu_transaksi_akhir,
            'total_pembelian_minimal' => $request->total_pembelian_minimal,
            'total_pembelian_maksimal' => $request->total_pembelian_maksimal,
            'total_pembayaran_minimal' => $request->total_pembayaran_minimal,
            'total_pembayaran_maksimal' => $request->total_pembayaran_maksimal,
        ];

        session()->put('laporan_pembelian', $new_data);
        session()->put('laporan_pembelian_filter', $filter);
        $return = array('status' => 'Valid');
        echo json_encode($return);
    }

    public function cetak()
    {
        $data = session()->get('laporan_pembelian');
        $filter = session()->get('laporan_pembelian_filter');
        session()->forget('laporan_pembelian');
        session()->forget('laporan_pembelian_filter');
        $pdf = PDF::loadView('owner.laporan-pembelian.cetak', compact('data', 'filter'));
        return $pdf->stream('Laporan-Pembelian.pdf');
    }

}
