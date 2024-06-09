<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PolyclinicController extends Controller
{
    public function index():View{
        $page_items=4;
        $polyclinics = Polyclinic::latest()->paginate($page_items);
        return view ('admin.polyclinics.index', compact('polyclinics', 'page_items'));
    }

    public function create():View{
        return view('admin.polyclinics.create');
    }

    public function store(Request $request):RedirectResponse{
        $data = $request->validate([
            'nama_poli'     => 'required',
            'keterangan'    => 'required'
        ]);

        Polyclinic::create($data);
        return redirect()->route('polyclinics.index')->with(['success' => 'Poliklinik Berhasil Ditambah!']);
    }

    public function edit($id):View{
        $polyclinic = Polyclinic::findOrFail($id);
        return view('admin.polyclinics.edit', compact('polyclinic'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $request->validate([
            'nama_poli'     => 'required',
            'keterangan'    => 'required'
        ]);

        $patient = Polyclinic::findOrFail($id);
        $patient->update($data);

        return redirect()->route('polyclinics.index')->with(['success' => 'Data poliklinik berhasail diedit']);
    }

    public function destroy($id):RedirectResponse{
        $patient = Polyclinic::findOrFail($id);
        $patient->delete();
        return redirect()->route('polyclinics.index')->with(['success' => 'Data Poliklinik Berhasil Dihapus!']);
    }

    public function getPolyclinic(){
        $data = Polyclinic::all();
        return response()->json($data);
    }
}
