<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama_bank',
        'atas_nama',
        'rekening',
        'biaya',
        'gambar',
        'contact_person',
        'keterangan',
    ];
}
