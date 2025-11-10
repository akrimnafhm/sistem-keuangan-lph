<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\Province;

class ProvinceBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinceModel = Province::class;

        $nameCorrections = [
            'DAERAH ISTIMEWA YOGYAKARTA' => 'D.I. YOGYAKARTA',
            'DAERAH KHUSUS IBUKOTA JAKARTA' => 'DKI JAKARTA',
            'KEPULAUAN BANGKA BELITUNG' => 'BANGKA BELITUNG',
            'SUMATERA UTARA' => 'SUMATRA UTARA',
            'SUMATERA BARAT' => 'SUMATRA BARAT',
            'SUMATERA SELATAN' => 'SUMATRA SELATAN',
        ];
        
        
        foreach ($nameCorrections as $oldName => $newName) {
            $provinceModel::where('name', $oldName)->update(['name' => $newName]);
        }

        // Data diambil dari Lampiran IV Kepkaban 22/2024
        $biayaData = [
            // Halaman 29-30 (Dalam Kota) & 31-32 (Luar Kota)
            ['name' => 'ACEH', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 140000, 'hotel_luar_kota' => 770000, 'transport_luar_kota' => 766000, 'tiket_pesawat_luar_kota' => 4492000, 'uhpd_luar_kota' => 360000],
            ['name' => 'SUMATRA UTARA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 699000, 'transport_luar_kota' => 1128000, 'tiket_pesawat_luar_kota' => 3808000, 'uhpd_luar_kota' => 370000],
            ['name' => 'RIAU', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 852000, 'transport_luar_kota' => 714000, 'tiket_pesawat_luar_kota' => 3016000, 'uhpd_luar_kota' => 370000],
            ['name' => 'KEPULAUAN RIAU', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 792000, 'transport_luar_kota' => 842000, 'tiket_pesawat_luar_kota' => 2500000, 'uhpd_luar_kota' => 370000],
            ['name' => 'JAMBI', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 580000, 'transport_luar_kota' => 806000, 'tiket_pesawat_luar_kota' => 2460000, 'uhpd_luar_kota' => 370000],
            ['name' => 'SUMATRA BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 701000, 'transport_luar_kota' => 892000, 'tiket_pesawat_luar_kota' => 2952000, 'uhpd_luar_kota' => 380000],
            ['name' => 'SUMATRA SELATAN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 861000, 'transport_luar_kota' => 870000, 'tiket_pesawat_luar_kota' => 2268000, 'uhpd_luar_kota' => 380000],
            ['name' => 'LAMPUNG', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 580000, 'transport_luar_kota' => 848000, 'tiket_pesawat_luar_kota' => 1583000, 'uhpd_luar_kota' => 380000],
            ['name' => 'BENGKULU', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 692000, 'transport_luar_kota' => 730000, 'tiket_pesawat_luar_kota' => 2621000, 'uhpd_luar_kota' => 380000],
            ['name' => 'BANGKA BELITUNG', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 649000, 'transport_luar_kota' => 706000, 'tiket_pesawat_luar_kota' => 2139000, 'uhpd_luar_kota' => 410000],
            ['name' => 'BANTEN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 724000, 'transport_luar_kota' => 1584000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 370000],
            ['name' => 'JAWA BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 686000, 'transport_luar_kota' => 912000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 430000],
            ['name' => 'DKI JAKARTA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 210000, 'hotel_luar_kota' => 730000, 'transport_luar_kota' => 512000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 530000],
            ['name' => 'JAWA TENGAH', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 750000, 'transport_luar_kota' => 728000, 'tiket_pesawat_luar_kota' => 2182000, 'uhpd_luar_kota' => 370000],
            ['name' => 'D.I. YOGYAKARTA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 845000, 'transport_luar_kota' => 1046000, 'tiket_pesawat_luar_kota' => 2268000, 'uhpd_luar_kota' => 420000],
            ['name' => 'JAWA TIMUR', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 814000, 'transport_luar_kota' => 978000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 410000],
            ['name' => 'BALI', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 1138000, 'transport_luar_kota' => 966000, 'tiket_pesawat_luar_kota' => 3262000, 'uhpd_luar_kota' => 480000],
            ['name' => 'NUSA TENGGARA BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 180000, 'hotel_luar_kota' => 907000, 'transport_luar_kota' => 974000, 'tiket_pesawat_luar_kota' => 3230000, 'uhpd_luar_kota' => 440000],
            ['name' => 'NUSA TENGGARA TIMUR', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 688000, 'transport_luar_kota' => 744000, 'tiket_pesawat_luar_kota' => 5081000, 'uhpd_luar_kota' => 430000],
            ['name' => 'KALIMANTAN BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 538000, 'transport_luar_kota' => 854000, 'tiket_pesawat_luar_kota' => 2781000, 'uhpd_luar_kota' => 380000],
            ['name' => 'KALIMANTAN TENGAH', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 140000, 'hotel_luar_kota' => 659000, 'transport_luar_kota' => 780000, 'tiket_pesawat_luar_kota' => 2984000, 'uhpd_luar_kota' => 360000],
            ['name' => 'KALIMANTAN SELATAN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 697000, 'transport_luar_kota' => 872000, 'tiket_pesawat_luar_kota' => 2995000, 'uhpd_luar_kota' => 380000],
            ['name' => 'KALIMANTAN TIMUR', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 804000, 'transport_luar_kota' => 1578000, 'tiket_pesawat_luar_kota' => 3797000, 'uhpd_luar_kota' => 430000],
            ['name' => 'KALIMANTAN UTARA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 904000, 'transport_luar_kota' => 948000, 'tiket_pesawat_luar_kota' => 4057000, 'uhpd_luar_kota' => 430000],
            ['name' => 'SULAWESI UTARA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 978000, 'transport_luar_kota' => 788000, 'tiket_pesawat_luar_kota' => 5102000, 'uhpd_luar_kota' => 370000],
            ['name' => 'GORONTALO', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 955000, 'transport_luar_kota' => 1042000, 'tiket_pesawat_luar_kota' => 4824000, 'uhpd_luar_kota' => 370000],
            ['name' => 'SULAWESI BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 704000, 'transport_luar_kota' => 1138000, 'tiket_pesawat_luar_kota' => 4867000, 'uhpd_luar_kota' => 410000],
            ['name' => 'SULAWESI SELATAN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 745000, 'transport_luar_kota' => 886000, 'tiket_pesawat_luar_kota' => 3829000, 'uhpd_luar_kota' => 430000],
            ['name' => 'SULAWESI TENGAH', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 951000, 'transport_luar_kota' => 842000, 'tiket_pesawat_luar_kota' => 5113000, 'uhpd_luar_kota' => 370000],
            ['name' => 'SULAWESI TENGGARA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 786000, 'transport_luar_kota' => 854000, 'tiket_pesawat_luar_kota' => 4182000, 'uhpd_luar_kota' => 380000],
            ['name' => 'MALUKU', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 667000, 'transport_luar_kota' => 1088000, 'tiket_pesawat_luar_kota' => 7081000, 'uhpd_luar_kota' => 380000],
            ['name' => 'MALUKU UTARA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 605000, 'transport_luar_kota' => 942000, 'tiket_pesawat_luar_kota' => 10001000, 'uhpd_luar_kota' => 430000],
            ['name' => 'PAPUA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 1038000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 8193000, 'uhpd_luar_kota' => 580000],
            ['name' => 'PAPUA BARAT', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 967000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 480000],
            ['name' => 'PAPUA BARAT DAYA', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 967000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 480000],
            ['name' => 'PAPUA TENGAH', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 1038000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000],
            ['name' => 'PAPUA SELATAN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 1526000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000],
            ['name' => 'PAPUA PEGUNUNGAN', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 1536000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000],
        ];

        foreach ($biayaData as $data) {
            $province = $provinceModel::where('name', $data['name'])->first();

            if ($province) {
                $province->update([
                    'transport_dalam_kota' => $data['transport_dalam_kota'],
                    'uhpd_dalam_kota' => $data['uhpd_dalam_kota'],
                    'hotel_luar_kota' => $data['hotel_luar_kota'],
                    'transport_luar_kota' => $data['transport_luar_kota'],
                    'tiket_pesawat_luar_kota' => $data['tiket_pesawat_luar_kota'],
                    'uhpd_luar_kota' => $data['uhpd_luar_kota'],
                ]);
            } else {
                // Jika provinsi tidak ditemukan, tampilkan peringatan
                $this->command->error('Province not found: ' . $data['name']);
            }
        }
    }
}