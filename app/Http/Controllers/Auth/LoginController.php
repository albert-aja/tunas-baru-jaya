<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo(Request $request)
    {
        if ($request->user()->hasRole('Admin')) {
            $this->redirectTo = route('Admin Beranda');
            return $this->redirectTo;
        } else if ($request->user()->hasRole('Owner')) {
            $this->redirectTo = route('Owner Beranda');
            return $this->redirectTo;
        } else if ($request->user()->hasRole('Kasir')) {
            $this->redirectTo = route('Kasir Beranda');
            return $this->redirectTo;
        } else {
            Auth::logout();
            return redirect()->route('Keluar');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $data = Arr::add($credentials, 'status', '1');
        return $data;
    }

    protected function authenticated(Request $request, $user)
    {
        alert()->success('' . General::get_greetings() . ' ' . $user->name . '', 'Login Berhasil');
        if ($request->user()->hasRole('Admin')) {
            return redirect()->route('Admin Beranda');
        } else if ($request->user()->hasRole('Owner')) {
            return redirect()->route('Owner Beranda');
        } else if ($user->hasRole('Kasir')) {
            return redirect()->route('Kasir Beranda');
        } else {
            Auth::logout();
        }
    }

    public function logout(Request $request)
    {
        return redirect()->route('Keluar');
    }
}
