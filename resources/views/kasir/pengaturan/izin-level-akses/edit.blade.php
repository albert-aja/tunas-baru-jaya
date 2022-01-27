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
        <form class="form-horizontal" id="FormSuntingIzinLevelAkses" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::checkbox_multiple(1, 'config_permissions', 'name', array('name'), '$0$', 'Izin', 'izin', $permission, 'id != ""') !!}            
            </div>
            {!! FormHelp::form_footer(route('Kasir Pengaturan')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Pengaturan Izin Level Akses Edit', $role->id) }}
@endpush

@push('page_scripts')
    @include('js.kasir.pengaturan.izin-level-akses.edit')
@endpush

