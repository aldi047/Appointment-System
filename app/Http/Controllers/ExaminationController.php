<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExaminationController extends Controller
{
    public function index():View{
        $examinations = Examination::latest()->paginate(5);
        dd($examinations);
        return view('examinations.index', compact('examinations'));
    }
}
