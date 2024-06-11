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
        ExaminationSchedule::create([
            'doctor_id'=> 1,
            'hari'=> 'Selasa',
            'jam_mulai'=> '7',
            'jam_selesai'=> '10',
        ]);
        ExaminationSchedule::create([
            'doctor_id'=> 2,
            'hari'=> 'Rabu',
            'jam_mulai'=> '15',
            'jam_selesai'=> '17',
        ]);
        ExaminationSchedule::create([
            'doctor_id'=> 3,
            'hari'=> 'Kamis',
            'jam_mulai'=> '19',
            'jam_selesai'=> '21',
        ]);
    }
}
