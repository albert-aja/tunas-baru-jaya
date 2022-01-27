@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $total_produk }}</h3>
                    <p>Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes fa-xs"></i>
                </div>
                <a href="{{ route('Kasir Produk') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $total_customer }}</h3>
                    <p>Customer</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users fa-xs"></i>
                </div>
                <a href="{{ route('Kasir Customer') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $total_pembelian }}</h3>
                    <p>Transaksi Pembelian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cart-plus fa-xs"></i>
                </div>
                <a href="{{ route('Kasir Pembelian') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $total_penjualan }}</h3>
                    <p>Transaksi Penjualan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cash-register fa-xs"></i>
                </div>
                <a href="{{ route('Kasir Penjualan') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Transaksi Bulan Ini</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <div id="chart1" style="height: 450px;"></div>
        </div>
    </div>

    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Pembayaran Bulan Ini</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <div id="chart2" style="height: 450px;"></div>
        </div>
    </div>
</section>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Kasir Beranda') }}
@endpush

@push('page_scripts')
    @include('js.kasir.beranda.index')
    <script>
        const chart1 = new Chartisan({
            el: '#chart1',
            url: "@chart('transaksi_chart')",
            hooks: new ChartisanHooks()
                .colors()
                .borderColors()
                .datasets([{ type: 'line', fill: false }, { type: 'line', fill: false }]),
        });        

        const chart2 = new Chartisan({
            el: '#chart2',
            url: "@chart('pembayaran_chart')",
            hooks: new ChartisanHooks()
                .colors()
                .borderColors()
                .datasets([{ type: 'line', fill: false }, { type: 'line', fill: false }]),
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp.' + value;
                            }
                        }
                    }]
                }
            }
        });        
    </script>
@endpush

