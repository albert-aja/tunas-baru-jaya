<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier as ModelsSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Supplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ModelsSupplier::create([
            'nama' => $request->nama,
            'hp' => $request->hp,
            'tlp' => $request->tlp,
            'fax' => $request->fax,
            'email' => $request->email,
            'alamat' => $request->alamat,
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
        $data = ModelsSupplier::findOrFail($id);
        return view('admin.supplier.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelsSupplier::findOrFail($id);
        return view('admin.supplier.edit', compact('data'));
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
        $data = ModelsSupplier::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
            'hp' => $request->hp,
            'tlp' => $request->tlp,
            'fax' => $request->fax,
            'email' => $request->email,
            'alamat' => $request->alamat,
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
        $data = ModelsSupplier::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus supplier.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsSupplier::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Melihat Supplier") ? '<a href="' . route('Admin Supplier Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>' : '');
            })
            ->make(true);
    }
}
