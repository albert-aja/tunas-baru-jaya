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
        <form class="form-horizontal" id="FormTambahProduk" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', '') !!}
                {!! FormHelp::select(1, 'ref_produk_kategori', 'id', array('nama'), '$0$', 'Kategori', 'kategori', 'Kategori', '', 'id != ""') !!}
                {!! FormHelp::select(1, 'ref_produk_satuan', 'id', array('nama'), '$0$', 'Satuan', 'satuan', 'Satuan', '', 'id != ""') !!}
                {!! FormHelp::input_file(1, 'Foto', 'foto', 'foto-produk', '') !!}
                {!! FormHelp::input_text(1, 'Stok Awal', 'stok', 'Stok Awal', '') !!}                
                {!! FormHelp::input_text(1, 'Harga Jual Distributor', 'harga_jual', 'Harga Jual Distributor', '') !!}                
                {!! FormHelp::input_text(1, 'Harga Jual Eceran', 'harga_jual_eceran', 'Harga Jual Eceran', '') !!}                
            </div>
            {!! FormHelp::form_footer(route('Admin Produk')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Produk Create') }}
@endpush

@push('page_scripts')
    @include('js.admin.produk.create')
@endpush

