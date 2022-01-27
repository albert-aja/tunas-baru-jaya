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
        <form class="form-horizontal" id="FormTambahCustomer" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', '') !!}
                {!! FormHelp::input_text(1, 'No. Handphone', 'hp', 'No. Handphone', '') !!}
                {!! FormHelp::input_text(1, 'No. Telepon', 'tlp', 'No. Telepon', '') !!}
                {!! FormHelp::input_text(1, 'No. Fax', 'fax', 'No. Fax', '') !!}
                {!! FormHelp::input_text(1, 'Email', 'email', 'Email', '') !!}
                {!! FormHelp::textarea(1, 'Alamat', 'alamat', 'Alamat', '') !!}            
            </div>
            {!! FormHelp::form_footer(route('Owner Customer')) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Customer Create') }}
@endpush

@push('page_scripts')
    @include('js.owner.customer.create')
@endpush

