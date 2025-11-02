<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelakuUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sttd',
        'nama_usaha',
        'alamat_lengkap',
        'wilayah_id',
        'skala_usaha',
        'jenis_produk',
        'jumlah_produk',
        'biaya',
        'jumlah_audit',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }
}

