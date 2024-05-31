<?php

namespace Database\Seeders;

use App\Models\Examination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Examination::create([
            'reg_polyclinic_id' => 1,
            'tgl_periksa'       => date("Y-m-d"),
            'catatan'           => 'Kontrol minggu depan',
            'biaya_periksa'     => 200000
        ]);

        Examination::create([
            'reg_polyclinic_id' => 2,
            'tgl_periksa'       => date("Y-m-d"),
            'catatan'           => 'Kontrol minggu kedua',
            'biaya_periksa'     => 180000
        ]);
    }
}
