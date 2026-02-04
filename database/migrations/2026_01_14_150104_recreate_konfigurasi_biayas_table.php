<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tabel lama jika ada agar bersih
        Schema::dropIfExists('konfigurasi_biayas');

        // Buat tabel baru dengan struktur sesuai permintaan
        Schema::create('konfigurasi_biayas', function (Blueprint $table) {
            $table->id();
            $table->string('komponen'); // Contoh: Fee BPJPH, Fee LPH
            
            // Kolom nominal untuk setiap skala usaha (Decimal untuk support rupiah & persen)
            $table->decimal('mikro', 15, 2)->default(0);
            $table->decimal('kecil', 15, 2)->default(0);
            $table->decimal('menengah', 15, 2)->default(0);
            $table->decimal('besar', 15, 2)->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_biayas');
    }
};