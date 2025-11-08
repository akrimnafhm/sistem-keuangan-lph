<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiBiaya extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pajak',
        'fee_uin_mikro',
        'fee_uin_menengah',
        'fee_uin_besar',
        'fee_lph_mikro',
        'fee_lph_menengah',
        'fee_lph_besar',
        'unit_cost_audit_mikro',
        'unit_cost_audit_menengah',
        'unit_cost_audit_besar',
    ];
}