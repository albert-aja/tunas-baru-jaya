@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="FormFilterData" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="waktu_transaksi" class="col-sm-2 control-label">Jenis Penjualan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="jenis_penjualan" id="jenis_penjualan" data-placeholder="Jenis Penjualan">
                            <option></option>
                            <option value="distributor">Penjualan Distributor</option>
                            <option value="eceran">Penjualan Eceran</option>
                        </select>
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="waktu_transaksi" class="col-sm-2 control-label">Waktu Transaksi</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="waktu_transaksi_awal" name="waktu_transaksi_awal" data-date-format="yyyy-mm-dd" placeholder="Waktu Transaksi Awal" value="" />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="waktu_transaksi_akhir" name="waktu_transaksi_akhir" data-date-format="yyyy-mm-dd" placeholder="Waktu Transaksi Akhir" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_penjualan" class="col-sm-2 control-label">Total Penjualan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_penjualan_minimal" name="total_penjualan_minimal" placeholder="Total Penjualan Minimal" value="" />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_penjualan_maksimal" name="total_penjualan_maksimal" placeholder="Total Penjualan Maksimal" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_pembayaran" class="col-sm-2 control-label">Total Pembayaran</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_pembayaran_minimal" name="total_pembayaran_minimal" placeholder="Total Pembayaran Minimal" value="" />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_pembayaran_maksimal" name="total_pembayaran_maksimal" placeholder="Total Pembayaran Maksimal" value="" />
                    </div>
                </div>                
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary" id="TombolForm" name="TombolForm">Cetak</button>                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Laporan Penjualan') }}
@endpush

@push('page_scripts')
    @include('js.owner.laporan-penjualan.index')
@endpush

