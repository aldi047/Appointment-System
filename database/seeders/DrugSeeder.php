<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Drug::create([
            'nama_obat' => 'Paracetamol @10 pack x 10 Tablet',
            'kemasan'   => 'Kotak',
            'harga'     => '25000',
        ]);

        Drug::create([
            'nama_obat' => 'Amoxilin @10 pack x 10 Tablet',
            'kemasan'   => 'Kotak',
            'harga'     => '30000',
        ]);

        Drug::create([
            'nama_obat' => 'Oskadon @10 pack x 10 Tablet',
            'kemasan'   => 'Kotak',
            'harga'     => '15000',
        ]);
    }
}
