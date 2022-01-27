@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th style="width:20%">Nama</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ Auth::user()->tlp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ Auth::user()->username }}</td>
                </tr>
                <tr>
                    <th>Level Akses</th>
                    <td>{{ GeneralHelp::get_level_akses(Auth::user()->getRoleNames()) }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer(Auth::user(), array(1,0,0), route('Owner Profil Edit'), '', '', '') !!}
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Profil') }}
@endpush

@push('page_scripts')
    @include('js.owner.profil.index')
@endpush

