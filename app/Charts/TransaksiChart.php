<?php

declare (strict_types = 1);

namespace App\Charts;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class TransaksiChart extends BaseChart
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
            array_push($dates, Carbon::parse($date)->isoFormat('dddd, D MMMM Y'));
            array_push($pembelian, Pembelian::where('waktu_transaksi', Carbon::parse($date)->isoFormat('YYYY-MM-DD'))->count());
            array_push($penjualan, Penjualan::where('waktu_transaksi', Carbon::parse($date)->isoFormat('YYYY-MM-DD'))->count());
        }

        return Chartisan::build()
            ->labels($dates)
            ->dataset('Pembelian', $pembelian)
            ->dataset('Penjualan', $penjualan);
    }
}
