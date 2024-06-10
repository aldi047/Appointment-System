<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index():View{
        $id = Auth::guard('doctor')->user()->id;
        $doctor = Doctor::findOrFail($id);
        return view('profiles.index', compact('doctor'));
    }

    public function edit($id):View{
        $doctor = Doctor::findOrFail($id);
        return view('profiles.edit', compact('doctor'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $this->validate($request, [
            'nama'          => 'required|max:50',
            'alamat'        => 'required|max:50',
            'no_hp'         => 'required|max:15'
        ]);

        $doctor = Doctor::findOrFail($id);
        // dd($data);
        $doctor->update($data);

        return redirect()->route('profiles.index')->with(['success' => 'Data Berhasail Diedit!']);
    }
}
