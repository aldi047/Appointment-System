<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\RegPolyclinic;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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
        // attemp ganti varible model user
        // $user = Patient::query()->where('nama', '=', $data_login['nama'])
        // ->where('alamat', '=', $data_login['alamat'])
        // ->firstOrFail();

        // if(Auth::guard('patient')->login($user)){
        //     return redirect('/');
        // }

        if (Auth::guard('admin')->attempt($data_login)){
            return redirect('/dashboard');
        }elseif(Auth::guard('patient')->attempt($data_login)){
            return redirect('/dashboard');
        }elseif(Auth::guard('doctor')->attempt($data_login)){
            return redirect('/dashboard');
        }else{
            return back()->with('error','Nama atau Alamat salah');
        }
    }

    public function register(Request $request){
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required|numeric|digits:16',
            'no_hp'     => 'required|max:15'
        ]);

        // if user exist auto login
        $user = Patient::query()->where('no_ktp', '=', $request->no_ktp);
        if($user->count() != 0){
            $data_user = $user->first();
            Auth::guard('patient')->attempt([
                'nama'      => $data_user->nama,
                'alamat'    => $data_user->alamat,
                'password'  =>  'password'
            ]);
            return redirect('/dashboard');
        }


        // create prefix
        $date = new DateTime();
        $prefix = $date->format('Ym');
        $patient_count = Patient::count();
        $patient_last = DB::table('patients')
        ->orderByDesc('no_rm')->first();
        $patient_last_number = $patient_last == null ? 0 : substr($patient_last->no_rm,7);;
        $count = $patient_count == 0 ? 1:$patient_last_number+1;

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
        return redirect('/dashboard');
    }

    public function logout(Request $request){
        // dd($request);
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function index():View{
        $registrations = RegPolyclinic::count();
        $patients = Patient::count();
        $doctors = Doctor::count();
        $name = '';
        if (Auth::guard('admin')->check()){
            $name = Auth::guard('admin')->user()->nama;
        } elseif (Auth::guard('doctor')->check()){
            $name = Auth::guard('doctor')->user()->nama;
        } else {
            $name = Auth::guard('patient')->user()->nama;
        }
        return view('dashboard', compact('registrations', 'name', 'patients', 'doctors'));
    }
}
