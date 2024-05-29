<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use DateTime;
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
            'nama'      => strtolower($request->nama),
            'alamat'  => strtolower($request->alamat),
            'password'  =>  'password'
        ];
        if (Auth::guard('admin')->attempt($data_login)) {
            return redirect('admin_dashboard');
        }elseif(Auth::guard('patient')->attempt($data_login)){
            return redirect('patient_dashboard');
        }elseif(Auth::guard('doctor')->attempt($data_login)){
            return redirect('doctor_dashboard');
        }else{
            Session::flash('error-message','Nama atau Alamat salah');
            return back();
        }
    }

    public function register(Request $request){
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required|numeric|digits:16',
            'no_hp'     => 'required|max:15'
        ]);

        // create prefix
        $date = new DateTime();
        $prefix = $date->format('Ym');
        $count = Patient::count() + 1;

        $no_rm = $prefix.'-'.$count;

        Patient::create([
            'nama'      => strtolower($request->nama),
            'alamat'    => strtolower($request->alamat),
            'no_ktp'    => $request->no_ktp,
            'no_hp'     => $request->no_hp,
            'no_rm'     => $no_rm
        ]);

        $data_login = [
            'nama'      => strtolower($request->nama),
            'alamat'  => strtolower($request->alamat),
            'password'  =>  'password'
        ];
        Auth::guard('patient')->attempt($data_login);
        return redirect('patient_dashboard');
    }

    public function logout(Request $request){
        // dd($request);
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
