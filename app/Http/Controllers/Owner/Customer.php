<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Customer as ModelsCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ModelsCustomer::create([
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
        $data = ModelsCustomer::findOrFail($id);
        return view('owner.customer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelsCustomer::findOrFail($id);
        return view('owner.customer.edit', compact('data'));
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
        $data = ModelsCustomer::findOrFail($id);
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
        $data = ModelsCustomer::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus customer.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsCustomer::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return (Auth::user()->can("Melihat Customer") ? '<a href="' . route('Owner Customer Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>' : '');
            })
            ->make(true);
    }
}
