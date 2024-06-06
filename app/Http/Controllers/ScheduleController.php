<?php

namespace App\Http\Controllers;

use App\Models\ExaminationSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use function Laravel\Prompts\alert;

class ScheduleController extends Controller
{
    public function index():View{
        $id = Auth::guard('doctor')->user()->id;
        $name = Auth::guard('doctor')->user()->nama;
        $schedules = DB::table('examination_schedules')
        ->where('doctor_id', '=', $id)
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();
        // dd($schedules);
        return view('schedules.index', compact('schedules', 'name'));
    }

    public function create():View{
        return view('schedules.create');
    }

    public function store(Request $request):RedirectResponse{
        $id = Auth::guard('doctor')->user()->id;
        $request->validate([
            'hari'          => "required|in:Senin,Selasa,Rabu,Kamis,Jumat",
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
        ]);

        // Check Schedule
        $prev_schedule = DB::table('examination_schedules')
            ->where('hari', '=', $request->hari)
            ->orWhere(function($query) use ($request){
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                ->whereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })
            ->count();
        // dd($prev_schedule, $request);

        if($prev_schedule > 0){
            $back_data = [
                'info'          => 'Sudah ada jadwal pada jam tersebut',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
            ];
            return Redirect::back()->with($back_data);
        }

        ExaminationSchedule::create([
            'doctor_id'     => $id,
            'hari'          => $request->hari,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
        ]);

        return redirect()->route('schedules.index');
    }

    public function edit($id):View{
        $schedule = ExaminationSchedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $request->validate([
            'hari'          => "required|in:Senin,Selasa,Rabu,Kamis,Jumat",
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
        ]);
        $schedule = ExaminationSchedule::findOrFail($id);
        $schedule->update($data);
        return redirect()->route('schedules.index');
    }

    public function destroy($id):RedirectResponse{
        $schedule = ExaminationSchedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index');
    }
}
