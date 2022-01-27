<?php

declare (strict_types = 1);

namespace App\Charts;

use App\Models\PembelianPembayaran;
use App\Models\PenjualanPembayaran;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class PembayaranChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $today = Carbon::today();
        $dates = [];
        $pembelian = [];
        $penjualan = [];

        $begin = Carbon::parse($today->startOfMonth())->isoFormat('DD-MM-YYYY');
        $end = Carbon::parse($today->endOfMonth())->isoFormat('DD-MM-YYYY');

        $period = CarbonPeriod::create($begin, $end);
        foreach ($period as $date) {
            $pembelian_nominal = PembelianPembayaran::where('waktu_transaksi', Carbon::parse($date)->isoFormat('YYYY-MM-DD'))->sum('nominal');
            $penjualan_nominal = PenjualanPembayaran::where('waktu_transaksi', Carbon::parse($date)->isoFormat('YYYY-MM-DD'))->sum('nominal');
            array_push($dates, Carbon::parse($date)->isoFormat('dddd, D MMMM Y'));
            array_push($pembelian, $pembelian_nominal);
            array_push($penjualan, $penjualan_nominal);
        }

        return Chartisan::build()
            ->labels($dates)
            ->dataset('Pembelian', $pembelian)
            ->dataset('Penjualan', $penjualan);
    }
}
