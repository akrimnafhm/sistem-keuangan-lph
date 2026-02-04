<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rekapitulasi_auditors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekapitulasi_biaya_id')->constrained()->onDelete('cascade');
            $table->foreignId('auditor_id')->constrained();

            // Snapshot Operasional
            $table->integer('mandays')->default(0);
            $table->decimal('tarif_uhpd', 15, 2)->default(0);
            $table->decimal('total_uhpd', 15, 2)->default(0);

            $table->decimal('biaya_transport', 15, 2)->default(0); // Darat/Lokal
            $table->decimal('biaya_pesawat', 15, 2)->default(0); // Input Manual
            $table->decimal('biaya_hotel', 15, 2)->default(0);   // Input Manual

            // Penghasilan
            $table->decimal('honor_tahap_1', 15, 2)->default(0); // Fixed
            $table->decimal('honor_tahap_2', 15, 2)->default(0); // Bagi Hasil
            $table->decimal('potongan_pph21', 15, 2)->default(0);
            $table->decimal('total_diterima', 15, 2)->default(0); // Take Home Pay

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi_auditors');
    }
};
