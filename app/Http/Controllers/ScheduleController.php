<?php

namespace App\Http\Controllers;

use App\Models\ExaminationSchedule;
use DateTime;
use DateTimeZone;
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

        // Get day of week now
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $dayofweek = $date->format('l');
        $days=[
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu','Minggu'
        ];
        $dow_number = date('N', strtotime($dayofweek));
        $today = $days[$dow_number-1];

        return view('schedules.index', compact('schedules', 'name', 'today'));
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

        // Can't add schedule at the same day
        if($this->isScheduleToday($request->hari)){
            $back_data = [
                'info'          => 'Tidak bisa menambah jadwal pada hari yang sama',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
            ];
            return Redirect::back()->with($back_data);
        }

        // Check Schedule Conflict
        if($this->isScheduleConflict($request)){
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

        return redirect()->route('schedules.index')->with('success', 'Jadwal Berhasail Ditambahkan!');
    }

    public function edit($id){
        $schedule = ExaminationSchedule::findOrFail($id);
        if($this->isScheduleToday($schedule->hari)){
            return redirect()->route('schedules.index');
        }
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $request->validate([
            'hari'          => "required|in:Senin,Selasa,Rabu,Kamis,Jumat",
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
        ]);

        // Can't add schedule at the same day
        if($this->isScheduleToday($request->hari)){
            $back_data = [
                'info'          => 'Tidak bisa menambah jadwal pada hari yang sama',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
            ];
            return Redirect::back()->with($back_data);
        }

        // Check Schedule Conflict
        if($this->isScheduleConflict($request)){
            $back_data = [
                'info'          => 'Sudah ada jadwal pada jam tersebut',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
            ];
            return Redirect::back()->with($back_data);
        }
        $schedule = ExaminationSchedule::findOrFail($id);
        $schedule->update($data);
        return redirect()->route('schedules.index')->with('success', 'Jadwal Berhasail Diedit!');;
    }

    public function destroy($id):RedirectResponse{
        $schedule = ExaminationSchedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with(['success', 'Jadwal Berhasail Dihapus!']);;
    }

    private function isScheduleConflict(Request $request){
        // Check Schedule
        $prev_schedule = DB::table('examination_schedules')
            ->where('hari', '=', $request->hari)
            ->where(function($query) use ($request){
                $query->orWhere(function($query) use ($request){
                    $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai]);
                })->orWhere(function($query) use ($request){
                    $query->whereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
                });
            })
            ->count();
        // dd($prev_schedule, $request);
        $isConflict = $prev_schedule > 0;
        return $isConflict;
    }

    private function isScheduleToday(String $request_day){
        // Get day of week now
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $dayofweek = $date->format('l');
        $days=[
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu','Minggu'
        ];
        $dow_number = date('N', strtotime($dayofweek));
        $today = $days[$dow_number-1];
        return $request_day == $today;
    }
}
