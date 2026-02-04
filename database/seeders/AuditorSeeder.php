<?php

namespace Database\Seeders;

use App\Models\Auditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auditors = [
            'Ira Setyaningsih',
            'Atika Yahdiyani Ikhsani', // Fixed typo: YAhdiyani -> Yahdiyani
            'Isma Kurniatanty',
            'Esti Wahyu Widowati',
            'Fitri Nurtaati',
            'Laili Nailul Muna',
            'Erny Qurotul Ainy',
            'Satya Hapsari',          // Fixed typo: HApsari -> Hapsari
            'Dwi Agustina Kurniawati',
            'Susy Yunita Prabawaty',
            'Maya Rahmayanti',
            'Sudarlin',
            'M. Arief Rochman',
            'Khusna Dwi Jayanti',     // Capitalized
            'Dias Idha Pramesti',
            'Agessty Ika Nurlita',    // Added space: AgesstyIka -> Agessty Ika
            'Ihshan Habi Ashshaadiq',
            'Ika Qurrotul Afifah',
        ];

        foreach ($auditors as $name) {
            // Buat email dummy dari nama
            $email = Str::slug($name) . '@lph-sistem.com';
            
            // Buat nomor HP acak (awalan 08 + 10 digit angka)
            $phone = '08' . mt_rand(1000000000, 9999999999);

            Auditor::create([
                'nama' => $name,
                'email' => $email,
                'nomor_aktif' => $phone,
                'status' => 'Aktif',
            ]);
        }
    }
}