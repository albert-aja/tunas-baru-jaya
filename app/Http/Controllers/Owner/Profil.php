<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profil extends Controller
{
    public function index()
    {
        return view('owner.profil.index');
    }

    public function edit()
    {
        return view('owner.profil.edit');
    }

    public function update(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
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

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }
}
