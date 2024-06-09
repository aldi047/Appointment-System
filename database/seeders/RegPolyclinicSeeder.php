<?php

namespace Database\Seeders;

use App\Models\RegPolyclinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegPolyclinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegPolyclinic::create([
            'patient_id'=> 1,
            'examination_schedule_id'=> 1,
            'keluhan'=> 'Pusing',
            'no_antrian'=> '1',
            'status_periksa'=> '0',
        ]);

        RegPolyclinic::create([
            'patient_id'=> 2,
            'examination_schedule_id'=> 1,
            'keluhan'=> 'Pusing',
            'no_antrian'=> '2',
            'status_periksa'=> '1',
        ]);

        RegPolyclinic::create([
            'patient_id'=> 1,
            'examination_schedule_id'=> 1,
            'keluhan'=> 'Kontrol',
            'no_antrian'=> '3',
            'status_periksa'=> '1',
        ]);
    }
}
