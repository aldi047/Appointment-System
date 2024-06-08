<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Polyclinic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index():View{
        $page_items=4;
        $doctors = DB::table('polyclinics')
        ->join('doctors','doctors.polyclinic_id', '=', 'polyclinics.id')
        ->paginate($page_items);
        return view('admin.doctors.index', compact('doctors', 'page_items'));
    }

    public function create():View{
        $polyclinics = Polyclinic::all();
        return view('admin.doctors.create', compact('polyclinics'));
    }

    public function store(Request $request):RedirectResponse{
        $data = $this->validate($request, [
            'nama'          => 'required|max:50',
            'alamat'        => 'required|max:50',
            'no_hp'         => 'required|max:15',
            'polyclinic_id' => 'required'
        ]);

        Doctor::create($data);

        return redirect()->route('doctors.index');
    }

    public function edit($id):View{
        $doctor=Doctor::findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $this->validate($request, [
            'nama'          => 'required|max:50',
            'alamat'        => 'required|max:50',
            'no_hp'         => 'required|max:15',
            'polyclinic_id' => 'required'
        ]);

        $doctor = Doctor::findOrFail($id);
        // dd($data);
        $doctor->update($data);

        return redirect()->route('doctors.index');
    }
}
