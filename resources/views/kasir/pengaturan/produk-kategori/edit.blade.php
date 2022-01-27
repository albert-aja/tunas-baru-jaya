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
        <form class="form-horizontal" id="FormSuntingProdukKategori" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', $data->nama) !!}                
            </div>
            {!! FormHelp::form_footer(route('Kasir Pengaturan')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Pengaturan Produk Kategori Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.kasir.pengaturan.produk-kategori.edit')
@endpush

