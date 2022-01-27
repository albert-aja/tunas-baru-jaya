<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class LaporanUtang extends Controller
{
    public function index()
    {
        return view('owner.laporan-utang.index');
    }

    public function proses(Request $request)
    {
        $datas = Customer::orderBy('nama')->get();
        $new_data = [];

        foreach ($datas as $data) {
            $utang = 1;

            if (!is_null($request->total_utang_minimal) and !is_null($request->total_utang_maksimal)) {
                if ($request->total_utang_minimal <= $data->get_total_utang() and $data->get_total_utang() <= $request->total_utang_maksimal) {
                    $utang = 1;
                } else {
                    $utang = 0;
                }
            }

            if ($utang == 1) {
                array_push($new_data, $data);
            }
        }

        session()->put('laporan_utang', $new_data);
        $return = array('status' => 'Valid');
        echo json_encode($return);
    }

    public function cetak()
    {
        $data = session()->get('laporan_utang');
        session()->forget('laporan_utang');
        $pdf = PDF::loadView('owner.laporan-utang.cetak', compact('data'));
        return $pdf->stream('Laporan-Utang.pdf');
    }
}
