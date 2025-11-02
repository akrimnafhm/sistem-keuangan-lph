<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_provinsi',
        'transport_dalam_kota',
        'uhpd_dalam_kota',
        'hotel_luar_kota',
        'transport_luar_kota',
        'tiket_pesawat_luar_kota',
        'uhpd_luar_kota',
    ];
}