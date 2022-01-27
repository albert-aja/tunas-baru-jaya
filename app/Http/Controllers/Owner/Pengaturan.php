<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Config\Role;
use App\Models\Ref\Produk\JenisKoreksi;
use App\Models\Ref\Produk\Kategori;
use App\Models\Ref\Produk\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Pengaturan extends Controller
{
    public function index()
    {
        return view('owner.pengaturan.index');
    }

    public function edit_izin_level_akses($id)
    {
        $role = Role::findOrFail($id);
        $full_permissions = $role->permissions;
        $permission = [];
        foreach ($full_permissions as $full_permission) {
            array_push($permission, $full_permission->name);
        }
        return view('owner.pengaturan.izin-level-akses.edit', compact('role', 'permission'));
    }

    public function update_izin_level_akses(Request $request, $id)
    {
        $izins = $request->input('izin');
        $akses = array();
        foreach ($izins as $izin) {
            array_push($akses, $izin);
        }

        $role = Role::findOrFail($id);

        $return_status = ($role->syncPermissions($akses) ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status);
        echo json_encode($return);
    }

    public function dt_izin_level_akses()
    {
        $data = Role::all();
        return DataTables::of($data)
            ->addColumn('banyak_permission', function ($data) {
                return count($data->permissions) . ' Izin';
            })
            ->addColumn('action', function ($data) {
                return '
                        <a href="' . route('Owner Pengaturan Izin Level Akses Edit', $data) . '" class="btn btn-xs btn-success"><i class="fas fa-edit"></i></a>
                       ';
            })
            ->make(true);
    }

    public function create_produk_kategori()
    {
        return view('owner.pengaturan.produk-kategori.create');
    }

    public function store_produk_kategori(Request $request)
    {
        $data = Kategori::create([
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function edit_produk_kategori($id)
    {
        $data = Kategori::findOrFail($id);
        return view('owner.pengaturan.produk-kategori.edit', compact('data'));
    }

    public function update_produk_kategori(Request $request, $id)
    {
        $data = Kategori::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy_produk_kategori(Request $request)
    {
        $data = Kategori::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus kategori produk.');
        echo json_encode($return);
    }

    public function dt_produk_kategori()
    {
        $data = Kategori::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Kategori Produk") ? '<a href="' . route('Owner Pengaturan Produk Kategori Edit', $data) . '" class="btn btn-xs btn-success"><i class="fas fa-edit"></i></a>' : '') . ' ' . (Auth::user()->can("Menghapus Kategori Produk") ? '<TombolHapus url="' . route('Owner Pengaturan Produk Kategori Destroy') . '" pertanyaan="Anda yakin ingin menghapus kategori produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }

    public function create_produk_satuan()
    {
        return view('owner.pengaturan.produk-satuan.create');
    }

    public function store_produk_satuan(Request $request)
    {
        $data = Satuan::create([
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function edit_produk_satuan($id)
    {
        $data = Satuan::findOrFail($id);
        return view('owner.pengaturan.produk-satuan.edit', compact('data'));
    }

    public function update_produk_satuan(Request $request, $id)
    {
        $data = Satuan::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy_produk_satuan(Request $request)
    {
        $data = Satuan::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus satuan produk.');
        echo json_encode($return);
    }

    public function dt_produk_satuan()
    {
        $data = Satuan::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Satuan Produk") ? '<a href="' . route('Owner Pengaturan Produk Satuan Edit', $data) . '" class="btn btn-xs btn-success"><i class="fas fa-edit"></i></a>' : '') . ' ' . (Auth::user()->can("Menghapus Satuan Produk") ? '<TombolHapus url="' . route('Owner Pengaturan Produk Satuan Destroy') . '" pertanyaan="Anda yakin ingin menghapus satuan produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }

    public function create_produk_jenis_koreksi()
    {
        return view('owner.pengaturan.produk-jenis-koreksi.create');
    }

    public function store_produk_jenis_koreksi(Request $request)
    {
        $data = JenisKoreksi::create([
            'nama' => $request->nama,
            'kondisi' => $request->kondisi,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function edit_produk_jenis_koreksi($id)
    {
        $data = JenisKoreksi::findOrFail($id);
        return view('owner.pengaturan.produk-jenis-koreksi.edit', compact('data'));
    }

    public function update_produk_jenis_koreksi(Request $request, $id)
    {
        $data = JenisKoreksi::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
            'kondisi' => $request->kondisi,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy_produk_jenis_koreksi(Request $request)
    {
        $data = JenisKoreksi::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus jenis koreksi produk.');
        echo json_encode($return);
    }

    public function dt_produk_jenis_koreksi()
    {
        $data = JenisKoreksi::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Mengubah Jenis Koreksi Stok Produk") ? '<a href="' . route('Owner Pengaturan Produk Jenis Koreksi Edit', $data) . '" class="btn btn-xs btn-success"><i class="fas fa-edit"></i></a>' : '') . ' ' . (Auth::user()->can("Menghapus Jenis Koreksi Stok Produk") ? '<TombolHapus url="' . route('Owner Pengaturan Produk Jenis Koreksi Destroy') . '" pertanyaan="Anda yakin ingin menghapus jenis koreksi produk ini?" parameter="id" value="' . $data->id . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></TombolHapus>' : '');
            })
            ->make(true);
    }
}
