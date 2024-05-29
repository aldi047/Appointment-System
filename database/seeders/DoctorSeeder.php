<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'polyclinic_id' => 1,
            'nama' => 'dokter',
            'alamat' => 'semarang',
            'no_hp' => '085909090909',
        ]);
    }
}
