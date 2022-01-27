@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Penjualan</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th style="width:20%">Customer</th>
                    <td>{{ ($data->customer != '' ? $data->get_customer->nama : '') }}</td>
                </tr>
                <tr>
                    <th>Waktu Transaksi</th>
                    <td>{{ Carbon::parse($data->waktu_transaksi)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <th>No. Faktur</th>
                    <td>{{ $data->no_faktur }}</td>
                </tr>
                <tr>
                    <th>Faktur</th>
                    <td>
                        <a href="{{ route('Kasir Penjualan Faktur', $data) }}" class="btn btn-primary btn-sm" target="_blank">Lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $data->keterangan }}</td>
                </tr>
                <tr>
                    <th>Total Belanja</th>
                    <td>{{ GeneralHelp::get_currency($data->get_total_harga()) }}</td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td>{{ GeneralHelp::get_currency($data->get_total_pembayaran()) }}</td>
                </tr>
                <tr>
                    <th>Sisa Pembayaran</th>
                    <td>{{ GeneralHelp::get_currency($data->get_total_harga() - $data->get_total_pembayaran()) }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>{{ $data->get_status_pembayaran->nama }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array((Auth::user()->can("Mengubah Penjualan") ? 1 : 0),(Auth::user()->can("Menghapus Penjualan") ? 1 : 0),1), route('Kasir Penjualan Edit', $data), route('Kasir Penjualan Destroy'), route('Kasir Penjualan'), 'Anda yakin ingin menghapus penjualan ini?') !!}
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Produk</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                        <thead>
                            <tr class="bg-custom">
                                <th>Nama</th>
                                <th>Kuantitas</th>
                                <th>Harga Jual</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pembayaran</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="daftar_data_2" style="width: 100%;" class="table table-bordered table-fix-last">
                        <thead>
                            <tr class="bg-custom">
                                <th>Waktu Transaksi</th>
                                <th>Nominal</th>
                                <th>Bukti Transaksi</th>
                                <th>Keterangan</th>                                
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Penjualan Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.kasir.penjualan.show')
@endpush

