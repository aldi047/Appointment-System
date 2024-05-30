<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable=[
        'reg_polyclinic_id',
        'tgl_periksa',
        'catatan',
        'biaya_periksa'
    ];
}
