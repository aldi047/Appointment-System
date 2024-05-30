<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PolyclinicSeeder::class);
        $this->call(DrugSeeder::class);
        $this->call(ExaminationScheduleSeeder::class);
        $this->call(RegPolyclinicSeeder::class);
        $this->call(ExaminationSeeder::class);
        $this->call(ExaminationDetailSeeder::class);
    }
}
