<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $fillable = [
        'nama_rak',
        'zona',
        'baris',
        'sekat_mulai',
        'sekat_selesai'
    ];
}