<?php

namespace Database\Seeders;

use App\Models\ExaminationDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExaminationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExaminationDetail::create([
            'examination_id'    => '1',
            'drug_id'           => '1',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '1',
            'drug_id'           => '2',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '1',
            'drug_id'           => '3',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '2',
            'drug_id'           => '2',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '2',
            'drug_id'           => '3',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '3',
            'drug_id'           => '1',
        ]);

        ExaminationDetail::create([
            'examination_id'    => '3',
            'drug_id'           => '2',
        ]);
    }
}
