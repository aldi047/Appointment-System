<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'nama'=> 'aldi',
            'alamat'=> 'brebes',
            'no_ktp'=> '1209129012901209',
            'no_hp'=> '085108510851',
            'no_rm'=> '202405-1'
        ]);
    }
}
