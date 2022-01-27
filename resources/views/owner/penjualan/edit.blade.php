@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Sunting Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="FormSuntingPenjualan" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::select(1, 'customer', 'id', array('nama'), '$0$', 'Customer', 'customer', 'Customer', $data->customer, 'id != "" AND deleted_at is null') !!}
                {!! FormHelp::input_date(1, 'Waktu Transaksi', 'waktu_transaksi', 'Waktu Transaksi', $data->waktu_transaksi) !!}
                {!! FormHelp::input_text(1, 'No. Faktur', 'no_faktur', 'No. Faktur', $data->no_faktur) !!}
                {!! FormHelp::textarea(1, 'Keterangan', 'keterangan', 'Keterangan', $data->keterangan) !!}
            </div>
            {!! FormHelp::form_footer(route('Owner Penjualan Show', $data)) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Penjualan Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.penjualan.edit')
@endpush

