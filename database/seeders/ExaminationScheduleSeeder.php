<?php

namespace Database\Seeders;

use App\Models\ExaminationSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExaminationScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExaminationSchedule::create([
            'doctor_id'=> 1,
            'hari'=> 'Senin',
            'jam_mulai'=> '10',
            'jam_selesai'=> '12',
        ]);
    }
}
