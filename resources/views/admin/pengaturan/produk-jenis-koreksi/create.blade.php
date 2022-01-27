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
        <form class="form-horizontal" id="FormTambahProdukJenisKoreksi" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', '') !!}                
                <div class="form-group">
                    <label for="kondisi" class="col-sm-2 control-label">Kondisi</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="kondisi" id="kondisi" data-placeholder="Kondisi">
                            <option></option>
                            <option value="Bertambah">Bertambah</option>
                            <option value="Berkurang">Berkurang</option>
                        </select>
                    </div>
                </div>
            </div>
            {!! FormHelp::form_footer(route('Admin Pengaturan')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Pengaturan Produk Jenis Koreksi Create') }}
@endpush

@push('page_scripts')
    @include('js.admin.pengaturan.produk-jenis-koreksi.create')
@endpush

