<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index():View{
        $page_items=4;
        $patients = DB::table('patients')
        ->orderByDesc('no_rm')->paginate($page_items);
        return view ('admin.patients.index', compact('patients', 'page_items'));
    }

    public function create():View{
        return view('admin.patients.create');
    }

    public function store(Request $request):RedirectResponse{
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required|numeric|digits:16',
            'no_hp'     => 'required|max:15'
        ]);

        // create prefix
        $date = new DateTime();
        $prefix = $date->format('Ym');
        $patient_count = Patient::count();
        $patient_last = DB::table('patients')
        ->orderByDesc('no_rm')->first()->no_rm;
        $patient_last_number = substr($patient_last,7);
        $count = $patient_count == 0 ? 1:$patient_last_number+1;

        $no_rm = $prefix.'-'.$count;

        Patient::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'no_ktp'    => $request->no_ktp,
            'no_hp'     => $request->no_hp,
            'no_rm'     => $no_rm
        ]);
        return redirect()->route('patients.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id):View{
        $patient = Patient::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_ktp'    => 'required|numeric|digits:16',
            'no_hp'     => 'required|max:15',
            'no_rm'     => 'required'
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($data);

        return redirect()->route('patients.index')->with(['success' => 'Data berhasail Diedit!']);
    }

    public function destroy($id):RedirectResponse{
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
