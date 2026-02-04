<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rekapitulasi_biayas', function (Blueprint $table) {
            // Tambah field pajak (snapshot nilai pajak saat itu)
            $table->decimal('pajak', 5, 2)->default(0)->after('biaya_admin_lph');
            
            // Hapus field pendapatan_lph
            $table->dropColumn('pendapatan_lph');
        });
    }

    public function down(): void
    {
        Schema::table('rekapitulasi_biayas', function (Blueprint $table) {
            // Kembalikan field pendapatan_lph
            $table->decimal('pendapatan_lph', 15, 2)->nullable()->after('sisa_margin');
            
            // Hapus field pajak
            $table->dropColumn('pajak');
        });
    }
};
