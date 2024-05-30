<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DrugController extends Controller
{
    public function index():View{
        $drugs = Drug::all();
        return view ('drugs.index', compact('drugs'));
    }

    public function create():View{
        return view('drugs.create');
    }

    public function store(Request $request):RedirectResponse{
        $this->validate($request, [
            'nama_obat' => 'required|max:50',
            'kemasan'   => 'required|max:35',
            'harga'     => 'required'
        ]);

        Drug::create([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);
        return redirect()->route('drugs.index');
    }

    public function edit($id):View{
        $drug = Drug::findOrFail($id);
        // dd($drug);
        return view('drugs.edit', compact('drug'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $this->validate($request, [
            'nama_obat' => 'required|max:50',
            'kemasan'   => 'required|max:35',
            'harga'     => 'required'
        ]);

        $drug = Drug::findOrFail($id);

        $drug->update([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('drugs.index');

    }

    public function destroy($id):RedirectResponse{
        $drug = Drug::findOrFail($id);
        $drug->delete();
        return redirect()->route('drugs.index')->with(['success' => 'Data Berhasil Dihapus!']);;
    }
}
