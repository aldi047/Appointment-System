<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegPolyclinic extends Model
{
    use HasFactory;

    protected $fillable=[
        'patient_id',
        'examination_schedule_id',
        'keluhan',
        'no_antrian',
        'status_periksa'
    ];
}
