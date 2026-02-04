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
        Schema::create('rekapitulasi_biayas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelaku_usaha_id')->constrained()->onDelete('cascade');
            $table->string('no_rekap')->unique()->nullable(); // Bisa generate nanti
            $table->enum('status', ['Draft', 'Final'])->default('Draft');
            $table->enum('wilayah', ['dalam_kota', 'luar_kota']);

            // Snapshot Data Keuangan (Nullable agar bisa Draft)
            $table->decimal('total_kontrak', 15, 2)->nullable();
            $table->decimal('unit_cost_auditor', 15, 2)->nullable();
            $table->decimal('potongan_bpjph', 15, 2)->nullable();
            $table->decimal('potongan_uin', 15, 2)->nullable();
            $table->decimal('biaya_admin_lph', 15, 2)->nullable(); // Jika ada admin LPH

            // Hasil Perhitungan
            $table->decimal('total_biaya_ops', 15, 2)->nullable(); // Total transport+uhpd
            $table->decimal('sisa_margin', 15, 2)->nullable(); // Uang yang dibagi
            $table->decimal('pendapatan_lph', 15, 2)->nullable(); // Jatah LPH (40% / sisa)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi_biayas');
    }
};
