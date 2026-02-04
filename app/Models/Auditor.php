<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auditor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'email',
        'nomor_aktif',
        'status',
    ];

    // Relasi ke Pelaku Usaha (Pivot)
    public function pelakuUsahas()
    {
        return $this->belongsToMany(PelakuUsaha::class, 'auditor_pelaku_usaha');
    }
}