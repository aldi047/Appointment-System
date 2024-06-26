<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationSchedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'doctor_id',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];
}
