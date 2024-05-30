<?php

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolyclinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Polyclinic::create([
            'nama_poli'=> 'Poli gigi',
            'keterangan'    => 'Melayani kesehatan gigi'
        ]);
    }
}
