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
            'nama'          => 'dokter',
            'alamat'        => 'semarang',
            'no_hp'         => '089500000001',
        ]);
        Doctor::create([
            'polyclinic_id' => 2,
            'nama'          => 'dokter2',
            'alamat'        => 'jakarta',
            'no_hp'         => '089500000002',
        ]);
        Doctor::create([
            'polyclinic_id' => 3,
            'nama'          => 'dokter3',
            'alamat'        => 'bandung',
            'no_hp'         => '089500000003',
        ]);
    }
}
