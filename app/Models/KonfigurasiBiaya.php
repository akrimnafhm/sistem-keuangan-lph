<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiBiaya extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_biayas';

    protected $fillable = [
        'komponen',
        'mikro',
        'kecil',
        'menengah',
        'besar',
    ];
}