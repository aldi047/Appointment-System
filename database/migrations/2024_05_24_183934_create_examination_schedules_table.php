<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('examination_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu']);
            $table->time('jam_mulai',0);
            $table->time('jam_selesai',0);
            $table->timestamps();
        });
        // https://stackoverflow.com/questions/53254477/crud-with-date-create-and-read
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_schedules');
    }
};
