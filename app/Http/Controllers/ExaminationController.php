<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    public function examinations():View{
        $examination_datas = DB::table('examinations')
        ->join('reg_polyclinics', 'examinations.reg_polyclinic_id', '=', 'reg_polyclinics.id')
        ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        ->select('reg_polyclinics.no_antrian', 'patients.nama', 'reg_polyclinics.keluhan', 'reg_polyclinics.status_periksa')->paginate(8);
        // dd($examination_datas);
        return view('examinations.queue', compact('examination_datas'));
    }
    public function history():View{
        $id = Auth::guard('doctor')->user()->id;
        $histories = DB::table('examinations')
        ->join('reg_polyclinics', 'examinations.reg_polyclinic_id', '=', 'reg_polyclinics.id')
        ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        // ->join('examination_details', 'examinations.id', '=', 'examination_details.examination_id')
        // ->join('drugs', 'examination_details.drug_id', '=', 'drugs.id')
        ->join('examination_schedules', 'reg_polyclinics.examination_schedule_id', '=', 'examination_schedules.id')
        ->join('doctors', 'examination_schedules.doctor_id', '=', 'doctors.id')
        ->select('examinations.id', 'examinations.tgl_periksa', 'doctors.nama', 'reg_polyclinics.keluhan', 'examinations.catatan')
        ->where('doctors.id', '=', $id)
        ->get();

        // Get Detail Periksa
        $drug_details = DB::table('examination_details')->get();
        // Get Obat
        $drug_listdb = DB::table('drugs')->get();
        // Set obat as list
        $drug_list=[];
        foreach($drug_listdb as $drug){
            $drug_list[$drug->id] = $drug->nama_obat;
        }

        // Set list obat
        $drugs=array();
        foreach($drug_details as $drug_detail){
            // Id periksa
            $id=$drug_detail->examination_id;
            // // Init value
            if(empty($drugs[$id])){
                $drugs[$id] = $drug_list[$drug_detail->drug_id];
                continue;
            }
            $array_before = $drugs[$id] .', '. $drug_list[$drug_detail->drug_id];
            // // Tambah ke list
            $drugs[$id] = $array_before;
        }
        return view('examinations.history', compact('histories', 'drugs'));
    }
}
