<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Config\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Pengguna extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tlp' => $request->tlp,
            'foto' => 'admin.png',
            'status' => '1',
        ]);

        $role = Role::findOrFail($request->role);
        $data->assignRole($role->name);

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
        $data = User::findOrFail($id);
        return view('admin.pengguna.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('data'));
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
        $data = User::findOrFail($id);
        $data->update([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'tlp' => $request->tlp,
        ]);

        if ($request->password != "") {
            $data->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $role = Role::findOrFail($request->role);
        $data->syncRoles($role->name);
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
        $data = User::findOrFail($request->id);
        $data->update([
            'status' => '0',
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus pengguna.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = User::where('status', '1');
        return DataTables::of($data)
            ->addColumn('level_akses', function ($data) {
                return General::get_level_akses($data->getRoleNames());
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Pengguna Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }
}
