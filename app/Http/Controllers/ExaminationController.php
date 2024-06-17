<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Examination;
use App\Models\ExaminationDetail;
use App\Models\Patient;
use App\Models\RegPolyclinic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

class ExaminationController extends Controller
{
    public function index():View{
        $page_items=6;
        $examination_datas = DB::table('patients')
        ->join('reg_polyclinics', 'patients.id', '=', 'reg_polyclinics.patient_id')
        ->select('reg_polyclinics.no_antrian', 'patients.nama', 'reg_polyclinics.keluhan', 'reg_polyclinics.status_periksa', 'reg_polyclinics.id')
        ->orderByDesc('reg_polyclinics.created_at')
        ->paginate($page_items);
        return view('doctor.examinations.queue', compact('examination_datas'));
    }

    public function create():View{
        $reg_poly_id = request()->id;
        $examination_data = DB::table('patients')
        ->join('reg_polyclinics', 'patients.id', '=', 'reg_polyclinics.patient_id')
        ->select('patients.nama', 'reg_polyclinics.id', 'reg_polyclinics.status_periksa')
        ->where('reg_polyclinics.id', '=', $reg_poly_id)
        ->first();
        return view('doctor.examinations.create', compact('examination_data'));
    }

    public function store(Request $request):RedirectResponse{
        $this->validate($request, [
            'reg_polyclinic_id' => 'required',
            'tgl_periksa'       => 'required',
            'catatan'           => 'required',
            'drug_id'           => 'required'
        ]);

        // Update examination status
        $data_regpoly = RegPolyclinic::findOrFail($request->reg_polyclinic_id);
        $data_regpoly->update([
            'status_periksa' => '1'
        ]);

        // Calculate examination fee
        $examination_fee = 150000;
        $drugs = DB::table('drugs')->whereIn('id',$request['drug_id'])->get(['id', 'harga']);
        foreach($drugs as $drug){
            $examination_fee += $drug->harga;
        }

        // Create Examination
        $examination_id = Examination::create([
            'reg_polyclinic_id' => $request->reg_polyclinic_id,
            'tgl_periksa'       => $request->tgl_periksa,
            'catatan'           => $request->catatan,
            'biaya_periksa'     => $examination_fee
        ]);

        // Create examination detail
        foreach($drugs as $drug){
            ExaminationDetail::create([
                'examination_id'    => $examination_id->id,
                'drug_id'           => $drug->id
            ]);
        }

        return redirect()->route('examinations.index')->with(['success' => 'Data Periksa Berhasil Disimpan!']);
    }

    public function edit($id):View{
        $examination_data = DB::table('examinations')
        ->join('reg_polyclinics', 'examinations.reg_polyclinic_id', '=', 'reg_polyclinics.id')
        ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        ->select('patients.nama', 'examinations.id', 'examinations.tgl_periksa', 'examinations.catatan','examinations.biaya_periksa')
        ->where('reg_polyclinics.id', '=', $id)
        ->first();
        $drugs = DB::table('examination_details')->where('examination_id', '=', $examination_data->id)->get('drug_id');
        $array_drugs = [];
        foreach($drugs as $drug){
            array_push($array_drugs, (string)$drug->drug_id);
        }
        return view('doctor.examinations.edit', compact('examination_data', 'array_drugs'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $this->validate($request, [
            'tgl_periksa'       => 'required',
            'catatan'           => 'required',
            'drug_id'           => 'required'
        ]);

        $examination_data = Examination::findOrFail($id);

        // Delete previous examination data
        DB::table('examination_details')
        ->where('examination_id', $examination_data->id)
        ->delete();

        // Calculate examination fee and insert detail
        $examination_fee = 150000;
        $drugs = DB::table('drugs')->whereIn('id',$request['drug_id'])->get(['id', 'harga']);
        foreach($drugs as $drug){
            // Calculate fee
            $examination_fee += $drug->harga;
            // Insert examination detail
            ExaminationDetail::create([
                'examination_id'    => $examination_data->id,
                'drug_id'           => $drug->id
            ]);
        }

        $examination_data->update([
            'tgl_periksa'       => $request->tgl_periksa,
            'catatan'           => $request->catatan,
            'biaya_periksa'     => $examination_fee
        ]);

        return redirect()->route('examinations.index')->with(['success' => 'Data Periksa berhasail Diedit!']);
    }

    public function history():View{
        $id = Auth::guard('doctor')->user()->id;
        $nama_dokter = Auth::guard('doctor')->user()->nama;
        $page_items = 5;

        // $histories_pasien = DB::table('examinations')
        // ->join('reg_polyclinics', 'examinations.reg_polyclinic_id', '=', 'reg_polyclinics.id')
        // ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        // ->join('examination_schedules', 'reg_polyclinics.examination_schedule_id', '=', 'examination_schedules.id')
        // ->select('patients.*','examinations.id', 'examinations.tgl_periksa', 'reg_polyclinics.keluhan', 'examinations.catatan')
        // ->where('examination_schedules.doctor_id', '=', $id)
        // ->where('patients.id', '=', 'reg_polyclinics.patient_id')
        // ->get();

        $histories = DB::table('reg_polyclinics')
        ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        ->join('examination_schedules', 'reg_polyclinics.examination_schedule_id', '=', 'examination_schedules.id')
        ->join('examinations', 'reg_polyclinics.id', '=', 'examinations.reg_polyclinic_id')
        ->where('examination_schedules.doctor_id', '=', $id)
        ->distinct()->select('patients.*')
        // ->select(DB::raw('DISTINCT nama, alamat, no_ktp, no_hp, no_rm'))
        ->paginate($page_items);
        // dd($histories);

        return view('doctor.examinations.history', compact('histories', 'nama_dokter', 'page_items'));
    }

    public function getDrugs(Request $request){
        $drugs = DB::table('drugs')
        ->where('nama_obat', 'like','%'.$request->search.'%')
        ->select(DB::raw('CONCAT(nama_obat, " - ", kemasan, " - Rp.", harga) AS text'), 'id')
        ->get();
        return response()->json($drugs, 200);
    }

    public function getDrugsSelected(String $id){
        $selected_drugs = DB::table('examination_details')
        ->where('examination_id', '=', $id)
        ->get('drug_id');

        $drug_list=[];
        foreach($selected_drugs as $drug){
            array_push($drug_list, (string)$drug->drug_id);
        }

        $drugs = DB::table('drugs')
        ->select(DB::raw('CONCAT(nama_obat, " - ", kemasan, " - Rp.", harga) AS text'), 'id')
        ->whereIn('id', $drug_list)
        ->get();

        return response()->json($drugs, 200);
    }

    public function getPatientHistory($no_rm){
        $idDokter = Auth::guard('doctor')->user()->id;
        $histories_pasien = DB::table('examinations')
        ->join('reg_polyclinics', 'examinations.reg_polyclinic_id', '=', 'reg_polyclinics.id')
        ->join('patients', 'reg_polyclinics.patient_id', '=', 'patients.id')
        ->join('examination_schedules', 'reg_polyclinics.examination_schedule_id', '=', 'examination_schedules.id')
        ->select('patients.*','examinations.id', 'examinations.tgl_periksa', 'reg_polyclinics.keluhan', 'examinations.catatan')
        ->where('examination_schedules.doctor_id', '=', $idDokter)
        ->where('patients.no_rm', '=', $no_rm)
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
        // foreach($histories_pasien->get() as $history){
        //     Object.defineProperty($histories_pasien, "obat", $drugs[$history->id]);
        // }
        // $histories_pasien->setCollection(collect($history_with_drugs));
        // $histories_pasien = $histories_pasien->get();
        $histories_pasien->transform(function($item, $key) use($drugs){
            // dd($item);
            $item->obat = $drugs[$item->id];
            return $item;
        });
        return response()->json($histories_pasien, 200);
    }
}
