@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Produk</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th style="width:20%">Nama</th>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if($data->foto != '')
                                <TombolPreviewFilePDF file="{{ asset('storage/produk/'.$data->foto) }}" class="btn btn-primary btn-sm">Lihat</TombolPreviewFilePDF>
                                <a href="{{ asset('storage/produk/'.$data->foto) }}" class="btn btn-success btn-sm"  download="{{ $data->nama }}">Download</a>
                                @else
                                Tidak Ada
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $data->get_kategori->nama }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $data->stok.' '.$data->get_satuan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual Distributor</th>
                            <td>{{ GeneralHelp::get_currency($data->harga_jual) }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual Eceran</th>
                            <td>{{ GeneralHelp::get_currency($data->harga_jual_eceran) }}</td>
                        </tr>
                    </table>
                </div>
                {!! GeneralHelp::get_default_show_footer($data, array((Auth::user()->can("Mengubah Produk") ? 1 : 0),(Auth::user()->can("Menghapus Produk") ? 1 : 0),1), route('Admin Produk Edit', $data), route('Admin Produk Destroy'), route('Admin Produk'), 'Anda yakin ingin menghapus produk ini?') !!}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-blue">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Koreksi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                        <thead>
                            <tr class="bg-custom">
                                <th>Jenis Koreksi</th>
                                <th>Kondisi</th>
                                <th>Kuantitas</th>                                
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>           
            </div>
        </div>
    </div>    
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Produk Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.produk.show')
@endpush

