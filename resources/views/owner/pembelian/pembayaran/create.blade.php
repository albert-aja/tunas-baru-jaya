@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="FormTambahPembelianPembayaran" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_date(1, 'Waktu Transaksi', 'waktu_transaksi', 'Waktu Transaksi', '') !!}
                {!! FormHelp::input_file(1, 'Bukti Transaksi', 'bukti_transaksi', 'file_bukti_transaksi', '') !!}
                {!! FormHelp::input_text_with_front_addon(1, 'Nominal', 'nominal', 'Nominal', '', 'Rp') !!}
                {!! FormHelp::textarea(1, 'Keterangan', 'keterangan', 'Keterangan', '') !!}
            </div>
            {!! FormHelp::form_footer(route('Owner Pembelian Show', $data)) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Pembelian Pembayaran Create', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.pembelian.pembayaran.create')
@endpush

