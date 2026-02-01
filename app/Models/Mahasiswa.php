<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nama',
        'g1',
        'g2',
        'g3',
        'absences',
        'studytime'
    ];
}
