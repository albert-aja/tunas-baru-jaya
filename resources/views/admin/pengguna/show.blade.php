@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Pengguna</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th style="width:20%">Nama</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ $data->tlp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $data->username }}</td>
                </tr>
                <tr>
                    <th>Level Akses</th>
                    <td>{{ GeneralHelp::get_level_akses($data->getRoleNames()) }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Admin Pengguna Edit', $data), route('Admin Pengguna Destroy'), route('Admin Pengguna'), 'Anda yakin ingin menghapus pengguna ini?') !!}
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Pengguna Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.pengguna.show')
@endpush

