@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="FormFilterData" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="total_utang" class="col-sm-2 control-label">Total Utang</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_utang_minimal" name="total_utang_minimal" placeholder="Total Utang Minimal" value="" />
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="total_utang_maksimal" name="total_utang_maksimal" placeholder="Total Utang Maksimal" value="" />
                    </div>
                </div>                       
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary" id="TombolForm" name="TombolForm">Cetak</button>                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Laporan Utang') }}
@endpush

@push('page_scripts')
    @include('js.owner.laporan-utang.index')
@endpush

