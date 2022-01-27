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
        
        <table style="width: 100%; margin-top: 20px; margin-bottom: 20px; font-size: 8pt;" class="table">
            <thead>
                <tr style="background-color: #eeeeee;">
                    <th colspan="4">Laporan Utang</th>
                </tr>
                <tr style="background-color: #eeeeee;">
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>No. Telepon</th>
                    <th>Total Utang</th>                    
                </tr>
            </thead>            
            @foreach ($data as $item)
                <tr>
                    <td style="text-align: left;">{{ $item->nama }}</td>
                    <td style="text-align: left;">{{ $item->hp }}</td>
                    <td style="text-align: left;">{{ $item->tlp }}</td>
                    <td style="text-align: right;">{{ GeneralHelp::get_currency($item->get_total_utang()) }}</td>                    
                </tr>                
            @endforeach            
        </table>            
    </body>
</html>
