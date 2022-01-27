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
        <form class="form-horizontal" id="FormSuntingProfil" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', Auth::user()->name) !!}
                {!! FormHelp::input_text(1, 'No. Telepon', 'tlp', 'No. Telepon', Auth::user()->tlp) !!}
                {!! FormHelp::input_text(1, 'Email', 'email', 'Email', Auth::user()->email) !!}
                {!! FormHelp::input_text(1, 'Username', 'username', 'Username', Auth::user()->username) !!}
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password <sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" />
                            <span class="input-group-btn"><TombolTypePass value="to text" class="btn btn-success" type="button"><i id="type_pass" class="fa fa-eye"></i></TombolTypePass></span>
                        </div>
                    </div>
                </div>
            </div>
            {!! FormHelp::form_footer(route('Kasir Profil')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Profil Edit') }}
@endpush

@push('page_scripts')
    @include('js.kasir.profil.edit')
@endpush

