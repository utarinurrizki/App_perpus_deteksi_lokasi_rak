<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'isbn',
        'jumlah_halaman',
        'edisi',
        'jumlah_buku',
        'status',
        'tahun',
        'kategori',
        'rak_id',
        'cover'
    ];

    // relasi ke tabel racks
    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rak_id');
    }
}