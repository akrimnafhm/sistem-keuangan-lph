<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Hapus data lama jika ada, untuk menghindari duplikat
        Wilayah::truncate();

        Schema::enableForeignKeyConstraints();
        

        // Data biaya per wilayah, diambil dari Lampiran IV Kepkaban 22/2024
        // dan PMK 60/2021 (SBM) untuk tarif hotel Eselon III/Golongan IV
        $wilayahs = [
            ['nama_provinsi' => 'Aceh', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 140000, 'hotel_luar_kota' => 1294000, 'transport_luar_kota' => 766000, 'tiket_pesawat_luar_kota' => 4492000, 'uhpd_luar_kota' => 360000],
            ['nama_provinsi' => 'Sumatra Utara', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1100000, 'transport_luar_kota' => 1128000, 'tiket_pesawat_luar_kota' => 3808000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Riau', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1650000, 'transport_luar_kota' => 714000, 'tiket_pesawat_luar_kota' => 3016000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Kepulauan Riau', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1037000, 'transport_luar_kota' => 842000, 'tiket_pesawat_luar_kota' => 2500000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Jambi', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1225000, 'transport_luar_kota' => 806000, 'tiket_pesawat_luar_kota' => 2460000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Sumatra Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1353000, 'transport_luar_kota' => 892000, 'tiket_pesawat_luar_kota' => 2952000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Sumatra Selatan', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1571000, 'transport_luar_kota' => 870000, 'tiket_pesawat_luar_kota' => 2268000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Lampung', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1140000, 'transport_luar_kota' => 848000, 'tiket_pesawat_luar_kota' => 1583000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Bengkulu', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1546000, 'transport_luar_kota' => 730000, 'tiket_pesawat_luar_kota' => 2621000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Bangka Belitung', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 1957000, 'transport_luar_kota' => 706000, 'tiket_pesawat_luar_kota' => 2139000, 'uhpd_luar_kota' => 410000],
            ['nama_provinsi' => 'Banten', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1000000, 'transport_luar_kota' => 1584000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Jawa Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1201000, 'transport_luar_kota' => 912000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'DKI Jakarta', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 210000, 'hotel_luar_kota' => 992000, 'transport_luar_kota' => 512000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 530000],
            ['nama_provinsi' => 'Jawa Tengah', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 954000, 'transport_luar_kota' => 728000, 'tiket_pesawat_luar_kota' => 2182000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'D.I. Yogyakarta', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1384000, 'transport_luar_kota' => 1046000, 'tiket_pesawat_luar_kota' => 2268000, 'uhpd_luar_kota' => 420000],
            ['nama_provinsi' => 'Jawa Timur', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 1076000, 'transport_luar_kota' => 978000, 'tiket_pesawat_luar_kota' => 2674000, 'uhpd_luar_kota' => 410000],
            ['nama_provinsi' => 'Bali', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 1078000, 'transport_luar_kota' => 966000, 'tiket_pesawat_luar_kota' => 3262000, 'uhpd_luar_kota' => 480000],
            ['nama_provinsi' => 'Nusa Tenggara Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 180000, 'hotel_luar_kota' => 1418000, 'transport_luar_kota' => 974000, 'tiket_pesawat_luar_kota' => 3230000, 'uhpd_luar_kota' => 440000],
            ['nama_provinsi' => 'Nusa Tenggara Timur', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1355000, 'transport_luar_kota' => 744000, 'tiket_pesawat_luar_kota' => 5081000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'Kalimantan Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1125000, 'transport_luar_kota' => 854000, 'tiket_pesawat_luar_kota' => 2781000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Kalimantan Tengah', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 140000, 'hotel_luar_kota' => 1160000, 'transport_luar_kota' => 780000, 'tiket_pesawat_luar_kota' => 2984000, 'uhpd_luar_kota' => 360000],
            ['nama_provinsi' => 'Kalimantan Selatan', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1500000, 'transport_luar_kota' => 872000, 'tiket_pesawat_luar_kota' => 2995000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Kalimantan Timur', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1507000, 'transport_luar_kota' => 1578000, 'tiket_pesawat_luar_kota' => 3797000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'Kalimantan Utara', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1507000, 'transport_luar_kota' => 948000, 'tiket_pesawat_luar_kota' => 4057000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'Sulawesi Utara', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1170000, 'transport_luar_kota' => 788000, 'tiket_pesawat_luar_kota' => 5102000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Gorontalo', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 160000, 'hotel_luar_kota' => 1606000, 'transport_luar_kota' => 1042000, 'tiket_pesawat_luar_kota' => 4824000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Sulawesi Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1075000, 'transport_luar_kota' => 1138000, 'tiket_pesawat_luar_kota' => 4867000, 'uhpd_luar_kota' => 410000],
            ['nama_provinsi' => 'Sulawesi Selatan', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1138000, 'transport_luar_kota' => 886000, 'tiket_pesawat_luar_kota' => 3829000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'Sulawesi Tengah', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1567000, 'transport_luar_kota' => 842000, 'tiket_pesawat_luar_kota' => 5113000, 'uhpd_luar_kota' => 370000],
            ['nama_provinsi' => 'Sulawesi Tenggara', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1297000, 'transport_luar_kota' => 854000, 'tiket_pesawat_luar_kota' => 4182000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Maluku', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 150000, 'hotel_luar_kota' => 1048000, 'transport_luar_kota' => 1088000, 'tiket_pesawat_luar_kota' => 7081000, 'uhpd_luar_kota' => 380000],
            ['nama_provinsi' => 'Maluku Utara', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 170000, 'hotel_luar_kota' => 1073000, 'transport_luar_kota' => 942000, 'tiket_pesawat_luar_kota' => 10001000, 'uhpd_luar_kota' => 430000],
            ['nama_provinsi' => 'Papua', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 2521000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 8193000, 'uhpd_luar_kota' => 580000],
            ['nama_provinsi' => 'Papua Barat', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 2056000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 480000],
            ['nama_provinsi' => 'Papua Barat Daya', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 190000, 'hotel_luar_kota' => 2056000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 480000], // Samakan dengan Papua Barat
            ['nama_provinsi' => 'Papua Tengah', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 2521000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000], // Samakan dengan Papua
            ['nama_provinsi' => 'Papua Selatan', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 2521000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000], // Samakan dengan Papua
            ['nama_provinsi' => 'Papua Pegunungan', 'transport_dalam_kota' => 170000, 'uhpd_dalam_kota' => 230000, 'hotel_luar_kota' => 2521000, 'transport_luar_kota' => 1538000, 'tiket_pesawat_luar_kota' => 10824000, 'uhpd_luar_kota' => 580000], // Samakan dengan Papua
        ];

        // Masukkan data ke database
        foreach ($wilayahs as $wilayah) {
            Wilayah::create($wilayah);
        }
    }
}
