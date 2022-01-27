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
        <form class="form-horizontal" id="FormTambahPengguna" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::select(1, 'config_roles', 'id', array('name'), '$0$', 'Level Akses', 'role', 'Level Akses', '', 'id != ""') !!}
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', '') !!}
                {!! FormHelp::input_text(1, 'No. Telepon', 'tlp', 'No. Telepon', '') !!}
                {!! FormHelp::input_text(1, 'Email', 'email', 'Email', '') !!}
                {!! FormHelp::input_text(1, 'Username', 'username', 'Username', '') !!}
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" />
                            <span class="input-group-btn"><TombolTypePass value="to text" class="btn btn-success" type="button"><i id="type_pass" class="fa fa-eye"></i></TombolTypePass></span>
                        </div>
                    </div>
                </div>
            </div>
            {!! FormHelp::form_footer(route('Admin Pengguna')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Pengguna Create') }}
@endpush

@push('page_scripts')
    @include('js.admin.pengguna.create')
@endpush

