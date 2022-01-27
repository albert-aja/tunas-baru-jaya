@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                <thead>
                    <tr class="bg-custom">
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Jual Distributo</th>
                        <th>Harga Jual Eceran</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Produk') }}
@endpush

@push('page_scripts')
    @include('js.kasir.produk.index')
@endpush

