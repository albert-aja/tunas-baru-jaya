@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-9">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <form class="form-horizontal" id="FormTambahPenjualan" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        {!! FormHelp::select(1, 'customer', 'id', array('nama'), '$0$', 'Customer', 'customer', 'Customer', '', 'id != "" AND deleted_at is null') !!}
                        {!! FormHelp::input_date(1, 'Waktu Transaksi', 'waktu_transaksi', 'Waktu Transaksi', '') !!}
                        {!! FormHelp::input_text(1, 'No. Faktur', 'no_faktur', 'No. Faktur', '') !!}
                        {!! FormHelp::textarea(1, 'Keterangan', 'keterangan', 'Keterangan', '') !!}
                        <div class="form-group">
                            <label for="produk" class="col-sm-2 control-label">Produk</label>
                            <div class="col-sm-10" id="konten_produk">
                                <input type="hidden" class="form-control" id="count_produk" name="count_produk" value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total" class="col-sm-2 control-label">Total</label>
                            <div class="col-sm-10" id="konten_produk">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp. </span>
                                    <input type="text" class="form-control" id="total" name="total" value="0" readonly />
                                </div>                                
                            </div>
                        </div>
                    </div>
                    {!! FormHelp::form_footer(route('Admin Penjualan')) !!}
                </form>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Pencarian Produk</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! FormHelp::select(0, 'produk', 'id', array('nama'), '$0$', 'Pencarian Produk', 'pencarian_produk', 'Pencarian Produk', '', 'id != "" AND deleted_at is null') !!}
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>    
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Penjualan Create') }}
@endpush

@push('page_scripts')
    @include('js.admin.penjualan.create')
@endpush

