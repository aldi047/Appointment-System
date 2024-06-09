<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic;
use App\Models\RegPolyclinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use stdClass;

class RegPolyclinicController extends Controller
{
    public function index():View{
        $id = Auth::guard('patient')->user()->id;
        $no_rm = Auth::guard('patient')->user()->no_rm;
        $polyclinics = Polyclinic::all();
        $histories = DB::table('polyclinics')
        ->join('doctors', 'polyclinics.id', '=', 'doctors.polyclinic_id')
        ->join('examination_schedules', 'doctors.id', '=', 'examination_schedules.doctor_id')
        ->join('reg_polyclinics', 'examination_schedules.id', '=', 'reg_polyclinics.examination_schedule_id')
        ->where('patient_id', '=', $id)
        ->orderByDesc('reg_polyclinics.created_at')
        ->get();
        // dd($histories);
        return view('patient.reg-poly', compact('no_rm', 'polyclinics', 'histories'));
    }

    public function store(Request $request){
        if($request->examination_schedule_id == null){
            $back_data = [
                'info'          => 'Jadwal masih kosong!',
                'keluhan'       => $request->keluhan
            ];
            return Redirect::back()->with($back_data);
        }
        $data = $this->validate($request, [
            'examination_schedule_id' => 'required',
            'keluhan'=> 'required',
        ]);

        $queue = DB::table('reg_polyclinics')
        ->where('examination_schedule_id', '=', $request->examination_schedule_id)
        ->orderByDesc('no_antrian')->first();

        $no_antrian = $queue->no_antrian + 1;
        $data += ['patient_id'=> Auth::guard('patient')->user()->id,
            'no_antrian'=> $no_antrian,
            'status_periksa'=> '0'];

        RegPolyclinic::create($data);

        return redirect('/reg-polyclinic')->with('success', 'Berhasil Mendaftar Poli');
    }

    public function detail($id){
        $history = DB::table('polyclinics')
        ->join('doctors', 'polyclinics.id', '=', 'doctors.polyclinic_id')
        ->join('examination_schedules', 'doctors.id', '=', 'examination_schedules.doctor_id')
        ->join('reg_polyclinics', 'examination_schedules.id', '=', 'reg_polyclinics.examination_schedule_id')
        ->where('reg_polyclinics.id', '=', $id)
        ->first();
        // dd($history);
        return view('patient.detail-history', compact('history'));
    }

    public function getSchedule($id){
        $datas = DB::table('doctors')
        ->join('examination_schedules', 'doctors.id', '=', 'examination_schedules.doctor_id')
        ->where('doctors.polyclinic_id', '=', $id)
        ->get();

        $schedule = [];
        foreach($datas as $data){
            array_push($schedule, [
                'id'    => $data->id,
                'desc'  => $data->nama . ' | ' . $data->hari . ' | ' . $data->jam_mulai . ' - ' . $data->jam_selesai]
            );
        }
        return response()->json($schedule);
    }
}
