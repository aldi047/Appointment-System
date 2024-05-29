<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Doctor extends Authenticable
{
    use HasFactory;

    protected $fillable=[
        'polyclinic_id',
        'nama',
        'alamat',
        'no_hp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
