<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
        ]);
        // dd('sampe sini');
        $data_login = [
            'name'      => $request->nama,
            'password'  => $request->alamat
        ];
        if (Auth::guard('admin')->attempt($data_login)) {
            return redirect('admin_dashboard');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }

    public function logout(Request $request){
        // dd($request);
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
