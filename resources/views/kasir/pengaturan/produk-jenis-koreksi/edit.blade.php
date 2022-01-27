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
        <form class="form-horizontal" id="FormSuntingProdukJenisKoreksi" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', $data->nama) !!}                
                <div class="form-group">
                    <label for="kondisi" class="col-sm-2 control-label">Kondisi</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="kondisi" id="kondisi" data-placeholder="Kondisi">
                            <option></option>
                            <option value="Bertambah" {{ ($data->kondisi == 'Bertambah' ? 'selected' : '') }}>Bertambah</option>
                            <option value="Berkurang" {{ ($data->kondisi == 'Berkurang' ? 'selected' : '') }}>Berkurang</option>
                        </select>
                    </div>
                </div>
            </div>
            {!! FormHelp::form_footer(route('Kasir Pengaturan')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Pengaturan Produk Jenis Koreksi Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.kasir.pengaturan.produk-jenis-koreksi.edit')
@endpush

