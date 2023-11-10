<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukutamuModel extends Model
{
    use HasFactory;
        protected $table = 'buku_tamu';
        protected $fillable = [
            'idtamu',
            'email',
            'nama_lengkap',
            'institusi',
            'lantai',
            'kunjungan',
            'selfie',
            'identitas',
            'konfirmasi',
            'jam_pulang',
    ];
}
