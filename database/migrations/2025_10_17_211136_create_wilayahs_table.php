<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_provinsi');
            // Data dari Lampiran IV Kepkaban 22/2024 (Dalam Kota)
            $table->decimal('transport_dalam_kota', 15, 2)->default(0);
            $table->decimal('uhpd_dalam_kota', 15, 2)->default(0);
            // Data dari Lampiran IV Kepkaban 22/2024 (Luar Kota)
            $table->decimal('hotel_luar_kota', 15, 2)->default(0);
            $table->decimal('transport_luar_kota', 15, 2)->default(0);
            $table->decimal('tiket_pesawat_luar_kota', 15, 2)->default(0);
            $table->decimal('uhpd_luar_kota', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayahs');
    }
};
