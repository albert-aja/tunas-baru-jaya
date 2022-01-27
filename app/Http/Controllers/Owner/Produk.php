<?php

namespace App\Http\Controllers\Owner;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Produk as ModelsProduk;
use App\Models\ProdukKoreksi;
use App\Models\Ref\Produk\JenisKoreksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $nama = md5(time());
            $extension = $request->file('foto')->getClientOriginalExtension();
            $nama_file = $nama . '.' . $extension;
            $request->file('foto')->storeAs('produk', $nama_file);
        } else {
            $nama_file = '';
        }

        $data = ModelsProduk::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'foto' => $nama_file,
            'harga_jual' => ($request->harga_jual == null ? 0 : $request->harga_jual),
            'harga_jual_eceran' => ($request->harga_jual_eceran == null ? 0 : $request->harga_jual_eceran),
            'stok' => ($request->stok == null ? 0 : $request->stok),
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
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
        $data = ModelsProduk::findOrFail($id);
        return view('owner.produk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelsProduk::findOrFail($id);
        return view('owner.produk.edit', compact('data'));
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
        $data = ModelsProduk::findOrFail($id);

        if ($request->hasFile('foto')) {
            $nama = md5(time());
            $extension = $request->file('foto')->getClientOriginalExtension();
            $nama_file = $nama . '.' . $extension;
            $request->file('foto')->storeAs('produk', $nama_file);
        } else {
            $nama_file = $data->foto;
        }

        $data->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
            'foto' => $nama_file,
            'harga_jual' => ($request->harga_jual == null ? 0 : $request->harga_jual),
            'harga_jual_eceran' => ($request->harga_jual_eceran == null ? 0 : $request->harga_jual_eceran),
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
        $data = ModelsProduk::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $link = route('Owner Produk');

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('link' => $link, 'status' => $return_status, 'text' => 'Berhasil menghapus produk.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsProduk::all();
        return DataTables::of($data)
            ->editColumn('kategori', function ($data) {
                return $data->get_kategori->nama;
            })
            ->editColumn('stok', function ($data) {
                return $data->stok . ' ' . $data->get_satuan->nama;
            })
            ->editColumn('harga_jual', function ($data) {
                return General::get_currency($data->harga_jual);
            })
            ->editColumn('harga_jual_eceran', function ($data) {
                return General::get_currency($data->harga_jual_eceran);
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Melihat Produk") ? '<a href="' . route('Owner Produk Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>' : '');
            })
            ->make(true);
    }

    public function koreksi_create($id)
    {
        $data = ModelsProduk::findOrFail($id);
        return view('owner.produk.koreksi.create', compact('data'));
    }

    public function koreksi_store(Request $request, $id)
    {
        $produk = ModelsProduk::findOrFail($id);
        $jenis_koreksi = JenisKoreksi::findOrFail($request->jenis_koreksi);
        $stok = ($jenis_koreksi->kondisi == 'Berkurang' ? $produk->stok - $request->kuantitas : $produk->stok + $request->kuantitas);

        $produk->update([
            'stok' => $stok,
        ]);

        $data = ProdukKoreksi::create([
            'produk' => $produk->id,
            'jenis_koreksi' => $request->jenis_koreksi,
            'kuantitas' => $request->kuantitas,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function koreksi_destroy(Request $request, $id)
    {
        $produk = ModelsProduk::findOrFail($id);
        $produk_koreksi = ProdukKoreksi::findOrFail($request->id);
        $jenis_koreksi = JenisKoreksi::findOrFail($produk_koreksi->jenis_koreksi);
        $stok = ($jenis_koreksi->kondisi == 'Berkurang' ? $produk->stok + $produk_koreksi->kuantitas : $produk->stok - $produk_koreksi->kuantitas);

        $produk->update([
            'stok' => $stok,
        ]);

        if ($produk_koreksi->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $link = route('Owner Produk Show', $produk);

        $return = array('link' => $link, 'id' => $produk->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function dt_koreksi($id)
    {
        $data = ProdukKoreksi::where('produk', $id)->get();
        return DataTables::of($data)
            ->editColumn('jenis_koreksi', function ($data) {
                return $data->get_jenis_koreksi->nama;
            })
            ->addColumn('kondisi', function ($data) {
                return $data->get_jenis_koreksi->kondisi;
            })
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Menghapus Koreksi Stok Produk") ? '<TombolHapus url="' . route('Owner Produk Koreksi Destroy', ['id' => $data->produk]) . '" pertanyaan="Anda yakin ingin menghapus koreksi produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }
}
