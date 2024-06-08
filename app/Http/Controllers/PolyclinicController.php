<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    public function getPolyclinic(){
        $data = Polyclinic::all();
        return response()->json($data);
    }
}
