<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama_obat',
        'kemasan',
        'harga',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
