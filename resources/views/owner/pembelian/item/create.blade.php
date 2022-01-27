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
        <form class="form-horizontal" id="FormTambahPembelianItem" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::select(1, 'produk', 'id', array('nama'), '$0$', 'Produk', 'produk', 'Produk', '', 'id != "" AND deleted_at is null') !!}
                {!! FormHelp::input_text(1, 'Kuantitas', 'kuantitas', 'Kuantitas', '') !!}
                {!! FormHelp::input_text_with_front_addon(1, 'Harga Beli', 'harga_beli', 'Harga Beli', '', 'Rp') !!}
                {!! FormHelp::input_text_with_front_addon(1, 'Harga Jual', 'harga_jual', 'Harga Jual', '', 'Rp') !!}                
            </div>
            {!! FormHelp::form_footer(route('Owner Pembelian Show', $data)) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Pembelian Item Create', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.pembelian.item.create')
@endpush

