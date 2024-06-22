<?php

namespace App\Http\Controllers;

use App\Models\ExaminationSchedule;
use DateTime;
use DateTimeZone;
use Hamcrest\Type\IsBoolean;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

use function Laravel\Prompts\alert;

class ScheduleController extends Controller
{
    public function index():View{
        $page_items=4;
        $id = Auth::guard('doctor')->user()->id;
        $name = Auth::guard('doctor')->user()->nama;
        $schedules = DB::table('examination_schedules')
        ->where('doctor_id', '=', $id)
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->paginate($page_items);
        // dd($schedules);

        // Get day of week now
        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $dayofweek = $date->format('l');
        $days=[
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu','Minggu'
        ];
        $dow_number = date('N', strtotime($dayofweek));
        $today = $days[$dow_number-1];

        return view('doctor.schedules.index', compact('schedules', 'name', 'today', 'page_items'));
    }

    public function create():View{
        return view('doctor.schedules.create');
    }

    public function store(Request $request):RedirectResponse{
        $id = Auth::guard('doctor')->user()->id;
        $request->validate([
            'hari'          => "required|in:Senin,Selasa,Rabu,Kamis,Jumat",
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
            'status'        => 'required'
        ]);

        // Can't add schedule at the same day
        if($this->isScheduleToday($request->hari)){
            $back_data = [
                'info'          => 'Tidak bisa menambah jadwal pada hari yang sama',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
                'status'        => $request->status,
            ];
            return Redirect::back()->with($back_data);
        }

        // Check Schedule Conflict
        if($this->isScheduleConflict($request, 0)){
            $back_data = [
                'info'          => 'Sudah ada jadwal pada jam tersebut',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
                'status'        => $request->status,
            ];
            return Redirect::back()->with($back_data);
        }
        
        $data = [
            'doctor_id'     => $id,
            'hari'          => $request->hari,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'status'        => $request->status
        ];
        if($request->status == 1){
            ExaminationSchedule::query()
            ->where('doctor_id', '=', Auth::guard('doctor')->user()->id)
            ->update(['status' => '0']);
        }
        ExaminationSchedule::create($data);

        return redirect()->route('schedules.index')->with('success', 'Jadwal Berhasail Ditambahkan!');
    }

    public function edit($id){
        $schedule = ExaminationSchedule::findOrFail($id);
        if($this->isScheduleToday($schedule->hari)){
            return redirect()->route('schedules.index');
        }
        return view('doctor.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id):RedirectResponse{
        $data = $request->validate([
            'hari'          => "required|in:Senin,Selasa,Rabu,Kamis,Jumat",
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
            'status'        => 'required'
        ]);

        // Can't add schedule at the same day
        if($this->isScheduleToday($request->hari)){
            $back_data = [
                'info'          => 'Tidak bisa menambah jadwal pada hari yang sama',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
                'status'        => $request->status
            ];
            return Redirect::back()->with($back_data);
        }

        // Check Schedule Conflict
        if($this->isScheduleConflict($request, $id)){
            $back_data = [
                'info'          => 'Sudah ada jadwal pada jam tersebut',
                'hari'          => $request->hari,
                'jam_mulai'     => $request->jam_mulai,
                'jam_selesai'   => $request->jam_selesai,
                'status'        => $request->status
            ];
            return Redirect::back()->with($back_data);
        }
        $schedule = ExaminationSchedule::findOrFail($id);
        if($request->status == 1){
            ExaminationSchedule::query()
            ->where('doctor_id', '=', Auth::guard('doctor')->user()->id)
            ->update(['status' => '0']);
        }
        $schedule->update($data);
        return redirect()->route('schedules.index')->with('success', 'Jadwal Berhasail Diedit!');;
    }

    public function destroy($id):RedirectResponse{
        $schedule = ExaminationSchedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success','Jadwal Berhasail Dihapus!');;
    }

    private function isScheduleConflict(Request $request, int $updateId){
        // Check Schedule
        $prev_schedule = DB::table('examination_schedules')
            ->where('hari', '=', $request->hari)
            ->where('doctor_id', '=', Auth::guard('doctor')->user()->id)
            ->where(function($query) use ($request){
                $query->orWhere(function($query) use ($request){
                    $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai]);
                })->orWhere(function($query) use ($request){
                    $query->whereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
                })->orWhere(function($query) use ($request){
                    $query->where('jam_mulai', '<', $request->jam_mulai)
                    ->where('jam_selesai', '>', $request->jam_selesai);
                });
            });
        // dd($prev_schedule, $request);
        if($updateId != 0){
            // dd($updateId);
            $prev_schedule = $prev_schedule->whereNot('id', '=', $updateId);
            // dd($data->get());
        }
        $prev_schedule_count = count($prev_schedule->get());
        $isConflict = $prev_schedule_count > 0;
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
