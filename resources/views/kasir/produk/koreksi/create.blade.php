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
        <form class="form-horizontal" id="FormTambahProdukKoreksi" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::select(1, 'ref_produk_jenis_koreksi', 'id', array('nama', 'kondisi'), '$0$ [$1$]', 'Jenis Koreksi', 'jenis_koreksi', 'Jenis Koreksi', '', 'id != "" and deleted_at is null') !!}
                {!! FormHelp::input_text(1, 'Kuantitas', 'kuantitas', 'Kuantitas', '') !!}                
            </div>
            {!! FormHelp::form_footer(route('Kasir Produk Show', $data)) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Produk Koreksi Create', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.kasir.produk.koreksi.create')
@endpush