<!DOCTYPE html>
<html>
	<head>
        <title>{{ config('app.name') }}</title>        
        <link rel="stylesheet" href="{{ asset('dashboard-package/themes/css/AdminLTE.css') }}">        
        <style>
            table {
                border-collapse: collapse !important;
                font-weight: 400;
            }
            td{
                padding: 5px;
            }
            th{
                padding: 8px;
            }
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -90px;
                left: 0px;
                right: 0px;
                height: 50px;                
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
	</head>

	<body>
        <header>
            <table style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <th style="width: 80px;"><img src="{{ asset('dashboard-package/img/logo/logo.jpeg') }}" style="width: 80px;"></th>
                    <th style="font-size: 16pt; text-align: left; vertical-align: middle !important;">UD. Tunas Baru Jaya</th>
                </tr>
            </table>
        </header>
        
        <table style="width: 50%; margin-bottom: 20px; margin-top: 20px; font-size: 8pt; font-weight: light; background-color: #eeeeee;">
            <tr>
                <td style="width: 30%;">Jenis Penjualan</td>
                <td style="text-align: left !important;">{{ ($filter['jenis_penjualan'] != '' ? ucwords($filter['jenis_penjualan']) : 'Semua') }}</td>
            </tr>
            <tr>
                <td style="">Waktu Transaksi</td>
                <td style="text-align: left;">{{ ((!is_null($filter['waktu_transaksi_awal']) and !is_null($filter['waktu_transaksi_akhir'])) ? Carbon::parse($filter['waktu_transaksi_awal'])->isoFormat('dddd, D MMMM Y').' - '.Carbon::parse($filter['waktu_transaksi_akhir'])->isoFormat('dddd, D MMMM Y') : '') }}</td>
            </tr>
            <tr>
                <td style="">Total Penjualan</td>
                <td style="text-align: left;">{{ ((!is_null($filter['total_penjualan_minimal']) and !is_null($filter['total_penjualan_maksimal'])) ? GeneralHelp::get_currency($filter['total_penjualan_minimal']).' - '.GeneralHelp::get_currency($filter['total_penjualan_maksimal']) : '') }}</td>
            </tr>
            <tr>
                <td style="">Total Pembayaran</td>
                <td style="text-align: left;">{{ ((!is_null($filter['total_pembayaran_minimal']) and !is_null($filter['total_pembayaran_maksimal'])) ? GeneralHelp::get_currency($filter['total_pembayaran_minimal']).' - '.GeneralHelp::get_currency($filter['total_pembayaran_maksimal']) : '') }}</td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 8pt;" class="table">
            <thead>
                <tr style="background-color: #aaaaaa;">
                    <th colspan="6">Laporan Penjualan</th>
                </tr>
                <tr style="background-color: #aaaaaa;">
                    <th>No. Faktur</th>
                    <th>Waktu Transaksi</th>
                    <th>Total Harga</th>
                    <th>Total Pembayaran</th>
                    <th>Sisa Pembayaran</th>
                    <th>Status Pembayaran</th>
                </tr>
                <tr style="background-color: #cccccc; font-size: 7pt; font-style: italic;">
                    <th></th>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>            
            @foreach ($data as $item)
                <tr>
                    <td style="text-align: left; border-top: 1px solid black !important;">{{ $item->no_faktur }}</td>
                    <td style="text-align: center; border-top: 1px solid black !important;">{{ Carbon::parse($item->waktu_transaksi)->isoFormat('dddd, D MMMM Y') }}</td>
                    <td style="text-align: right; border-top: 1px solid black !important;">{{ GeneralHelp::get_currency($item->get_total_harga()) }}</td>
                    <td style="text-align: right; border-top: 1px solid black !important;">{{ GeneralHelp::get_currency($item->get_total_pembayaran()) }}</td>
                    <td style="text-align: right; border-top: 1px solid black !important;">{{ GeneralHelp::get_currency($item->get_total_harga() - $item->get_total_pembayaran()) }}</td>
                    <td style="text-align: center; border-top: 1px solid black !important;">{{ $item->get_status_pembayaran->nama }}</td>
                </tr>
                @foreach ($item->get_item as $item)
                    <tr style="font-size: 6.5pt; background-color: #eeeeee; font-style: italic;">
                        <td style="text-align: left;"></td>
                        <td style="text-align: left;">{{ $item->get_produk->nama }}</td>
                        <td style="text-align: right;">{{ $item->kuantitas.' '.$item->get_produk->get_satuan->nama }}</td>
                        <td style="text-align: right;">{{ GeneralHelp::get_currency($item->harga_jual) }}</td>
                        <td style="text-align: right;">{{ GeneralHelp::get_currency($item->kuantitas * $item->harga_jual) }}</td>
                        <td style="text-align: center;"></td>
                    </tr>                    
                @endforeach
                
            @endforeach
        </table>            
    </body>
</html>
