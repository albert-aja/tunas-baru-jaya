<?php

namespace App\Http\Controllers\Owner;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Pembelian as ModelsPembelian;
use App\Models\PembelianItem;
use App\Models\PembelianPembayaran;
use App\Models\Produk;
use App\Models\Ref\Pembelian\StatusPembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Pembelian extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.pembelian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.pembelian.create');
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
        $pembelian = ModelsPembelian::create([
            'waktu_transaksi' => $request->waktu_transaksi,
            'no_faktur' => $request->no_faktur,
            'keterangan' => $request->keterangan,
            'pembayaran' => $pembayaran->id,
        ]);

        $produk = $data['produk'];
        $harga_beli = $data['harga_beli'];
        $harga_jual = $data['harga_jual'];
        $kuantitas = $data['kuantitas'];

        foreach ($produk as $key => $item) {
            $produk_data = Produk::findOrFail($produk[$key]);
            $pembelian_item = PembelianItem::create([
                'pembelian' => $pembelian->id,
                'produk' => $produk[$key],
                'kuantitas' => $kuantitas[$key],
                'harga_beli' => $harga_beli[$key],
                'harga_jual' => $harga_jual[$key],
            ]);

            $produk_data->update([
                'stok' => ($produk_data->stok + $kuantitas[$key]),
            ]);
        }

        $return_status = ($pembelian != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $pembelian->id, 'status' => $return_status);
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
        $data = ModelsPembelian::findOrFail($id);
        return view('owner.pembelian.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelsPembelian::findOrFail($id);
        return view('owner.pembelian.edit', compact('data'));
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
        $data = ModelsPembelian::findOrFail($id);
        $data->update([
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
        $data = ModelsPembelian::findOrFail($request->id);

        $item_all = PembelianItem::where('pembelian', $data->id)->get();
        $pembayaran_all = PembelianPembayaran::where('pembelian', $data->id)->get();

        foreach ($item_all as $item) {
            $produk = Produk::withTrashed()->findOrFail($item->produk);
            $produk->update([
                'stok' => ($produk->stok - $item->kuantitas),
            ]);
            $item->delete();
        }

        foreach ($pembayaran_all as $pembayaran) {
            $pembayaran->delete();
        }

        $link = route('Owner Pembelian');

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('link' => $link, 'status' => $return_status, 'text' => 'Berhasil menghapus pembelian.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsPembelian::all();
        return DataTables::of($data)
            ->editColumn('pembayaran', function ($data) {
                return $data->get_status_pembayaran->nama;
            })
            ->addColumn('total_harga', function ($data) {
                return General::get_currency($data->get_total_harga());
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Melihat Pembelian") ? '<a href="' . route('Owner Pembelian Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>' : '');
            })
            ->make(true);
    }

    public function item_create($id)
    {
        $data = ModelsPembelian::findOrFail($id);
        return view('owner.pembelian.item.create', compact('data'));
    }

    public function item_store(Request $request, $id)
    {
        $data = PembelianItem::create([
            'pembelian' => $id,
            'produk' => $request->produk,
            'kuantitas' => $request->kuantitas,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        $produk = Produk::findOrFail($request->produk);
        $produk->update([
            'stok' => ($produk->stok + $request->kuantitas),
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function item_destroy(Request $request, $id)
    {
        $data = PembelianItem::findOrFail($request->id);
        $produk = Produk::findOrFail($data->produk);
        $produk->update([
            'stok' => ($produk->stok - $data->kuantitas),
        ]);
        $link = route('Owner Pembelian Show', ['id' => $data->pembelian]);

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
        $data = PembelianItem::where('pembelian', $id)->get();
        return DataTables::of($data)
            ->addColumn('nama', function ($data) {
                return $data->get_produk->nama;
            })
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' ' . $data->get_produk->get_satuan->nama;
            })
            ->editColumn('harga_beli', function ($data) {
                return General::get_currency($data->harga_beli);
            })
            ->editColumn('harga_jual', function ($data) {
                return General::get_currency($data->harga_jual);
            })
            ->addColumn('subtotal', function ($data) {
                return General::get_currency($data->harga_beli * $data->kuantitas);
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Pembelian") ? '<TombolHapus url="' . route('Owner Pembelian Item Destroy', ['id' => $data->pembelian]) . '" pertanyaan="Anda yakin ingin menghapus produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }

    public function pembayaran_create($id)
    {
        $data = ModelsPembelian::findOrFail($id);
        return view('owner.pembelian.pembayaran.create', compact('data'));
    }

    public function pembayaran_store(Request $request, $id)
    {
        $data = ModelsPembelian::findOrFail($id);
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

        PembelianPembayaran::create([
            'pembelian' => $data->id,
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
        $data = ModelsPembelian::findOrFail($id);
        $total_harga = $data->get_total_harga();
        $total_pembayaran = $data->get_total_pembayaran();
        $data_pembayaran = PembelianPembayaran::findOrFail($request->id);
        $final_pembayaran = ($total_pembayaran - $data_pembayaran->nominal);
        $status = ($total_harga - $final_pembayaran > 0 ? 'Belum Lunas' : 'Lunas');
        $pembayaran = StatusPembayaran::where('nama', $status)->first();
        $data->update([
            'pembayaran' => $pembayaran->id,
        ]);

        $link = route('Owner Pembelian Show', ['id' => $id]);

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
        $data = PembelianPembayaran::where('pembelian', $id)->get();
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
                return (Auth::user()->can("Mengubah Pembelian") ? '<TombolHapus url="' . route('Owner Pembelian Pembayaran Destroy', ['id' => $data->pembelian]) . '" pertanyaan="Anda yakin ingin menghapus pembayaran ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function req(Request $request)
    {
        if ($request->req == 'Form Produk Pembelian') {
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
                                            <input type="text" class="form-control update_subtotal" urutan="' . $request->next_produk . '" id="kuantitas_' . $request->next_produk . '" name="kuantitas[]" placeholder="Kuantitas" value="" />
                                            <span class="input-group-addon" id="satuan_produk_' . $request->next_produk . '">' . $produk->get_satuan->nama . '</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp. </span>
                                            <input type="text" class="form-control harga_beli update_subtotal" urutan="' . $request->next_produk . '" id="harga_beli_' . $request->next_produk . '" name="harga_beli[]" placeholder="Harga Beli" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                        <span class="input-group-addon">Rp. </span>
                                        <input type="text" class="form-control harga_jual" urutan="' . $request->next_produk . '" id="harga_jual_' . $request->next_produk . '" name="harga_jual[]" placeholder="Harga Jual" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp. </span>
                                            <input type="text" class="subtotal form-control" urutan="' . $request->next_produk . '" id="subtotal_field_' . $request->next_produk . '" name="subtotal_field[]" placeholder="Subtotal" value="" readonly />
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
