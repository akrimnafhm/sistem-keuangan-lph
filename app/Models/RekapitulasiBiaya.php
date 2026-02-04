<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiBiaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelaku_usaha_id',
        'no_rekap',
        'status',
        'wilayah',
        'total_kontrak',
        'unit_cost_auditor',
        'potongan_bpjph',
        'potongan_uin',
        'biaya_admin_lph',
        'pajak',
        'total_biaya_ops',
        'sisa_margin',
    ];

    public function pelakuUsaha()
    {
        return $this->belongsTo(PelakuUsaha::class);
    }

    public function auditors()
    {
        return $this->hasMany(RekapitulasiAuditor::class);
    }

    public function details()
    {
        return $this->hasMany(RekapitulasiAuditor::class);
    }
}
