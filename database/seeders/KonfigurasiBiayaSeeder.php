<?php

namespace Database\Seeders;

use App\Models\KonfigurasiBiaya;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiBiayaSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu
        DB::table('konfigurasi_biayas')->truncate();

        $data = [
            [
                'komponen' => 'Fee BPJPH',
                'mikro' => 300000,
                'kecil' => 300000,
                'menengah' => 5000000,
                'besar' => 12500000,
            ],
            [
                'komponen' => 'Fee LPH',
                'mikro' => 480000,
                'kecil' => 480000,
                'menengah' => 980000,
                'besar' => 1440000,
            ],
            [
                'komponen' => 'Fee UIN',
                'mikro' => 300000,
                'kecil' => 300000,
                'menengah' => 1000000,
                'besar' => 2000000,
            ],
            [
                'komponen' => 'Unit Cost', // Dalam Persen
                'mikro' => 60,
                'kecil' => 60,
                'menengah' => 40,
                'besar' => 40,
            ],
            [
                'komponen' => 'Pajak', // Dalam Persen
                'mikro' => 11,
                'kecil' => 11,
                'menengah' => 11,
                'besar' => 11,
            ],
        ];

        foreach ($data as $item) {
            KonfigurasiBiaya::create($item);
        }
    }
}