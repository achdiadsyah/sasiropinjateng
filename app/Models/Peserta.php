<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'nomor_str',
        'no_handphone',
        'province_id',
        'regencie_id',
        'pengurus',
        'lama_seminar',
        'hari_seminar',
        'kode_unik',
        'is_verified'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regencie()
    {
        return $this->belongsTo(Regencie::class);
    }
}
