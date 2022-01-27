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
                    <th style="width: 80px;"><img src="dashboard-package/img/logo/logo.jpeg" style="width: 80px;"></th>
                    <th style="font-size: 16pt; text-align: left; vertical-align: middle !important;">UD. Tunas Baru Jaya</th>
                </tr>
            </table>
        </header>
        
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <th style="font-size: 14pt; text-align: right; font-weight: light;">Invoice Penjualan</th>
            </tr>
        </table>
        <table style="width: 100%; margin-bottom: 20px; font-size: 11pt; font-weight: light; background-color: #eeeeee;">
            <tr>
                <td style="width: 33%; padding: 20px; border-right: 1px solid white; vertical-align: top;"><span style="font-size: 9pt;">Kepada:</span><br><br>{{ $data->get_customer->nama }}</td>
                <td style="width: 33%; padding: 20px; border-right: 1px solid white; vertical-align: top;">
                    <span style="font-size: 9pt;">Invoice</span>
                    <table style="width: 100%; font-size: 9pt;">
                        <tr>
                            <td>No</td>
                            <td>{{ $data->no_faktur }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>{{ Carbon::parse($data->waktu_transaksi)->isoFormat('dddd, D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>{{ $data->get_status_pembayaran->nama }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 33%; padding: 20px; vertical-align: top;"><span style="font-size: 9pt;">Total (IDR)</span><br><br>{{ GeneralHelp::get_currency($data->get_total_harga()) }}</td>
            </tr>
        </table>
        <table style="width: 100%; margin-bottom: 20px; font-size: 8pt;" class="table">
            <thead>
                <tr style="background-color: #eeeeee;">
                    <th colspan="5">Daftar Produk</th>                    
                </tr>
                <tr style="background-color: #eeeeee;">
                    <th>No.</th>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>Harga<br>(IDR)</th>
                    <th>Jumlah<br>(IDR)</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            @foreach ($data->get_item as $item)
                <tr>
                    <td style="width: 3%;">{{ $no }}</td>
                    <td style="text-align: left;">{{ $item->get_produk->nama }}</td>
                    <td style="text-align: center;">{{ $item->kuantitas.' '.$item->get_produk->get_satuan->nama }}</td>
                    <td style="text-align: right;">{{ GeneralHelp::get_currency($item->harga_jual) }}</td>
                    <td style="text-align: right;">{{ GeneralHelp::get_currency($item->kuantitas * $item->harga_jual) }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
            <tfoot>
                <tr style="background-color: #eeeeee;">
                    <th colspan="4">Total</th>
                    <th style="text-align: right;">{{ GeneralHelp::get_currency($data->get_total_harga()) }}</th>
                </tr>
            </tfoot>
        </table>

        <table style="width: 100%; font-size: 8pt;" class="table">
            <thead>
                <tr style="background-color: #eeeeee;">
                    <th colspan="3">Riwayat Pembayaran</th>                    
                </tr>
                <tr style="background-color: #eeeeee;">
                    <th>No.</th>
                    <th>Waktu Transaksi</th>
                    <th>Nominal<br>(IDR)</th>                    
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            @foreach ($data->get_pembayaran as $pembayaran)
                <tr>
                    <td style="width: 3%;">{{ $no }}</td>
                    <td style="text-align: left;">{{ Carbon::parse($pembayaran->waktu_transaksi)->isoFormat('dddd, D MMMM Y') }}</td>
                    <td style="text-align: right;">{{ GeneralHelp::get_currency($pembayaran->nominal) }}</td>                    
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
            <tfoot>
                <tr style="background-color: #eeeeee;">
                    <th colspan="2">Total</th>
                    <th style="text-align: right;">{{ GeneralHelp::get_currency($data->get_total_pembayaran()) }}</th>
                </tr>
                <tr style="background-color: #eeeeee;">
                    <th colspan="2">Sisa Pembayaran</th>
                    <th style="text-align: right;">{{ GeneralHelp::get_currency($data->get_total_harga() - $data->get_total_pembayaran()) }}</th>
                </tr>
            </tfoot>
        </table><br><br><br>
        <p style="font-size: 8.5pt; font-weight: bold;">Saran Pembayaran</p>
        <p style="font-size: 8pt;">Silakan melakukan pembayaran dengan transfer ke rekening berikan:</p>
        <p style="font-size: 8pt;">Bank Mandiri norek 1050012744839</p>
        <p style="font-size: 8pt;">Bank BRI norek 019401000212565</p>
        <p style="font-size: 8pt;">a/n Hendra Cipta Panggabean</p><br><br>
        <p style="font-size: 8pt; text-align: center;">Terimakasih Atas Kerjasamanya. God bless us</p>
    </body>
</html>
