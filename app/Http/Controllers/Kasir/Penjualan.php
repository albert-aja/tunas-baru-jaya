<?php

namespace App\Http\Controllers\Kasir;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Penjualan as ModelsPenjualan;
use App\Models\PenjualanItem;
use App\Models\PenjualanPembayaran;
use App\Models\Produk;
use App\Models\Ref\Penjualan\StatusPembayaran;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Penjualan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kasir.penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kasir.penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $pembayaran = StatusPembayaran::where('nama', 'Belum Lunas')->first();
        $penjualan = ModelsPenjualan::create([
            'customer' => $request->customer,
            'waktu_transaksi' => $request->waktu_transaksi,
            'no_faktur' => $request->no_faktur,
            'keterangan' => $request->keterangan,
            'pembayaran' => $pembayaran->id,
        ]);

        $produk = $data['produk'];
        $kuantitas = $data['kuantitas'];

        foreach ($produk as $key => $item) {
            $produk_data = Produk::findOrFail($produk[$key]);
            $penjualan_item = PenjualanItem::create([
                'penjualan' => $penjualan->id,
                'produk' => $produk[$key],
                'kuantitas' => $kuantitas[$key],
                'harga_jual' => (is_null($penjualan->customer) ? $produk_data->harga_jual_eceran : $produk_data->harga_jual),
            ]);

            $produk_data->update([
                'stok' => ($produk_data->stok - $kuantitas[$key]),
            ]);
        }

        $return_status = ($penjualan != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $penjualan->id, 'status' => $return_status);
        echo json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        return view('kasir.penjualan.show', compact('data'));
    }

    public function faktur($id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        $pdf = PDF::loadView('kasir.penjualan.faktur', compact('data'));
        return $pdf->stream('Faktur Penjualan ' . $data->no_faktur . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        return view('kasir.penjualan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        $data->update([
            'customer' => $request->customer,
            'waktu_transaksi' => $request->waktu_transaksi,
            'no_faktur' => $request->no_faktur,
            'keterangan' => $request->keterangan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = ModelsPenjualan::findOrFail($request->id);

        $item_all = PenjualanItem::where('penjualan', $data->id)->get();
        $pembayaran_all = PenjualanPembayaran::where('penjualan', $data->id)->get();

        foreach ($item_all as $item) {
            $produk = Produk::findOrFail($item->produk);
            $produk->update([
                'stok' => ($produk->stok + $item->kuantitas),
            ]);
            $item->delete();
        }

        foreach ($pembayaran_all as $pembayaran) {
            $pembayaran->delete();
        }

        $link = route('Kasir Penjualan');

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('link' => $link, 'status' => $return_status, 'text' => 'Berhasil menghapus penjualan.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsPenjualan::all();
        return DataTables::of($data)
            ->addColumn('customer', function ($data) {
                return ($data->customer != '' ? $data->get_customer->nama : '');
            })
            ->editColumn('waktu_transaksi', function ($data) {
                return Carbon::parse($data->waktu_transaksi)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('pembayaran', function ($data) {
                return $data->get_status_pembayaran->nama;
            })
            ->addColumn('total_harga', function ($data) {
                return General::get_currency($data->get_total_harga());
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Melihat Penjualan") ? '<a href="' . route('Kasir Penjualan Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>' : '');
            })
            ->make(true);
    }

    public function item_create($id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        return view('kasir.penjualan.item.create', compact('data'));
    }

    public function item_store(Request $request, $id)
    {
        $produk = Produk::findOrFail($request->produk);
        $penjualan = ModelsPenjualan::findOrFail($id);
        $data = PenjualanItem::create([
            'penjualan' => $id,
            'produk' => $request->produk,
            'kuantitas' => $request->kuantitas,
            'harga_jual' => (is_null($penjualan->customer) ? $produk->harga_jual_eceran : $produk->harga_jual),
        ]);

        $produk->update([
            'stok' => ($produk->stok - $request->kuantitas),
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function item_destroy(Request $request, $id)
    {
        $data = PenjualanItem::findOrFail($request->id);
        $produk = Produk::findOrFail($data->produk);
        $produk->update([
            'stok' => ($produk->stok + $data->kuantitas),
        ]);
        $link = route('Kasir Penjualan Show', ['id' => $data->penjualan]);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('link' => $link, 'status' => $return_status, 'text' => 'Berhasil menghapus produk.');
        echo json_encode($return);
    }

    public function dt_item($id)
    {
        $data = PenjualanItem::where('penjualan', $id)->get();
        return DataTables::of($data)
            ->addColumn('nama', function ($data) {
                return $data->get_produk->nama;
            })
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' ' . $data->get_produk->get_satuan->nama;
            })
            ->editColumn('harga_jual', function ($data) {
                return General::get_currency($data->harga_jual);
            })
            ->addColumn('subtotal', function ($data) {
                return General::get_currency($data->harga_jual * $data->kuantitas);
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Penjualan") ? '<TombolHapus url="' . route('Kasir Penjualan Item Destroy', ['id' => $data->penjualan]) . '" pertanyaan="Anda yakin ingin menghapus produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }

    public function pembayaran_create($id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        return view('kasir.penjualan.pembayaran.create', compact('data'));
    }

    public function pembayaran_store(Request $request, $id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        $total_harga = $data->get_total_harga();
        $total_pembayaran = $data->get_total_pembayaran();
        $final_pembayaran = ($total_pembayaran + $request->nominal);
        $status = ($total_harga - $final_pembayaran > 0 ? 'Belum Lunas' : 'Lunas');
        $pembayaran = StatusPembayaran::where('nama', $status)->first();

        $data->update([
            'pembayaran' => $pembayaran->id,
        ]);

        if ($request->hasFile('bukti_transaksi')) {
            $nama = md5(time());
            $extension = $request->file('bukti_transaksi')->getClientOriginalExtension();
            $nama_file = $nama . '.' . $extension;
            $request->file('bukti_transaksi')->storeAs('bukti-transaksi', $nama_file);
        } else {
            $nama_file = '';
        }

        PenjualanPembayaran::create([
            'penjualan' => $data->id,
            'waktu_transaksi' => $request->waktu_transaksi,
            'nominal' => $request->nominal,
            'bukti_transaksi' => $nama_file,
            'keterangan' => $request->keterangan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function pembayaran_destroy(Request $request, $id)
    {
        $data = ModelsPenjualan::findOrFail($id);
        $total_harga = $data->get_total_harga();
        $total_pembayaran = $data->get_total_pembayaran();
        $data_pembayaran = PenjualanPembayaran::findOrFail($request->id);
        $final_pembayaran = ($total_pembayaran - $data_pembayaran->nominal);
        $status = ($total_harga - $final_pembayaran > 0 ? 'Belum Lunas' : 'Lunas');
        $pembayaran = StatusPembayaran::where('nama', $status)->first();
        $data->update([
            'pembayaran' => $pembayaran->id,
        ]);

        $link = route('Kasir Penjualan Show', ['id' => $id]);

        if ($data_pembayaran->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('link' => $link, 'status' => $return_status, 'text' => 'Berhasil menghapus pembayaran.');
        echo json_encode($return);
    }

    public function dt_pembayaran($id)
    {
        $data = PenjualanPembayaran::where('penjualan', $id)->get();
        return DataTables::of($data)
            ->editColumn('waktu_transaksi', function ($data) {
                return Carbon::parse($data->waktu_transaksi)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('bukti_transaksi', function ($data) {
                return ($data->bukti_transaksi != '' ? '<TombolPreviewFile file="' . asset("storage/app/bukti-transaksi/$data->bukti_transaksi") . '" class="btn btn-primary btn-xs">Lihat</TombolPreviewFile>' : 'Tidak Ada');
            })
            ->editColumn('nominal', function ($data) {
                return General::get_currency($data->nominal);
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Penjualan") ? '<TombolHapus url="' . route('Kasir Penjualan Pembayaran Destroy', ['id' => $data->penjualan]) . '" pertanyaan="Anda yakin ingin menghapus pembayaran ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function req(Request $request)
    {
        if ($request->req == 'Form Produk Penjualan') {
            $produk = Produk::findOrFail($request->produk);

            if ($produk->id != "") {
                return '
                        <div class="row" id="produk_' . $request->next_produk . '">
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <div class="col-sm-6" urutan="' . $request->next_produk . '">
                                        ' . $produk->nama . '
                                        <input type="hidden" class="form-control" urutan="' . $request->next_produk . '" id="produk_' . $request->next_produk . '" name="produk[]" placeholder="" value="' . $produk->id . '" />
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp. </span>
                                            <input type="text" class="form-control harga_jual update_subtotal" urutan="' . $request->next_produk . '" id="harga_jual_' . $request->next_produk . '" name="harga_jual[]" placeholder="Harga Jual" value="' . ($request->customer == '' ? $produk->harga_jual_eceran : $produk->harga_jual) . '" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control update_subtotal" urutan="' . $request->next_produk . '" id="kuantitas_' . $request->next_produk . '" name="kuantitas[]" placeholder="Kuantitas" value="" />
                                            <span class="input-group-addon" id="satuan_produk_' . $request->next_produk . '">' . $produk->get_satuan->nama . '</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp. </span>
                                            <input type="text" class="subtotal form-control" urutan="' . $request->next_produk . '" id="subtotal_field_' . $request->next_produk . '" name="subtotal_field[]" placeholder="Subtotal" value="" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <TombolHapusProduk class="btn btn-sm btn-danger" urutan="' . $request->next_produk . '"><i class="fas fa-trash"></i></TombolHapusProduk>
                            </div>
                        </div>
                        <hr id="divider_' . $request->next_produk . '">
                       ';
            } else {
                return '';
            }

        }
    }
}
