<?php

namespace Database\Seeders;

use App\Models\KonfigurasiBiaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonfigurasiBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat satu baris data konfigurasi default (sebagai angka bulat)
        KonfigurasiBiaya::create([
            'pajak' => 11,
            'fee_uin_mikro' => 300000,
            'fee_uin_menengah' => 1000000,
            'fee_uin_besar' => 2000000,
            'fee_lph_mikro' => 480000,
            'fee_lph_menengah' => 980000,
            'fee_lph_besar' => 1440000,
            'unit_cost_audit_mikro' => 60,
            'unit_cost_audit_menengah' => 40,
            'unit_cost_audit_besar' => 40,
        ]);
    }
}