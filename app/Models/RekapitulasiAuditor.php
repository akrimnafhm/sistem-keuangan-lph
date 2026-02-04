<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiAuditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekapitulasi_biaya_id',
        'auditor_id',
        'mandays',
        'tarif_uhpd',
        'total_uhpd',
        'biaya_transport',
        'biaya_pesawat',
        'biaya_hotel',
    ];

    /**
     * Relasi ke Rekapitulasi Biaya (parent)
     */
    public function rekapitulasiBiaya()
    {
        return $this->belongsTo(RekapitulasiBiaya::class, 'rekapitulasi_biaya_id');
    }

    /**
     * Relasi ke Auditor (hanya referensi, snapshot tetap disimpan di tabel ini)
     */
    public function auditor()
    {
        return $this->belongsTo(Auditor::class);
    }
}
