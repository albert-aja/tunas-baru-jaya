@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Supplier</h3>
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
                    <th>No. Handphone</th>
                    <td>{{ $data->hp }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ $data->tlp }}</td>
                </tr>
                <tr>
                    <th>No. Fax</th>
                    <td>{{ $data->fax }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $data->alamat }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array((Auth::user()->can("Mengubah Supplier") ? 1 : 0),(Auth::user()->can("Menghapus Supplier") ? 1 : 0),1), route('Owner Supplier Edit', $data), route('Owner Supplier Destroy'), route('Owner Supplier'), 'Anda yakin ingin menghapus supplier ini?') !!}
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Supplier Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.supplier.show')
@endpush

