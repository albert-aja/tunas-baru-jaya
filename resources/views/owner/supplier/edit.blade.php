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
        <form class="form-horizontal" id="FormSuntingSupplier" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', $data->nama) !!}
                {!! FormHelp::input_text(1, 'No. Handphone', 'hp', 'No. Handphone', $data->hp) !!}
                {!! FormHelp::input_text(1, 'No. Telepon', 'tlp', 'No. Telepon', $data->tlp) !!}
                {!! FormHelp::input_text(1, 'No. Fax', 'fax', 'No. Fax', $data->fax) !!}
                {!! FormHelp::input_text(1, 'Email', 'email', 'Email', $data->email) !!}
                {!! FormHelp::textarea(1, 'Alamat', 'alamat', 'Alamat', $data->alamat) !!}            
            </div>
            {!! FormHelp::form_footer(route('Owner Supplier Show', $data)) !!}
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Supplier Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.supplier.edit')
@endpush

