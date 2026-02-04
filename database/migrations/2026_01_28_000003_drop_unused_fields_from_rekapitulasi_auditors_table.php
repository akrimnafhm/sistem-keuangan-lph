<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rekapitulasi_auditors', function (Blueprint $table) {
            $table->dropColumn([
                'honor_tahap_1',
                'honor_tahap_2',
                'potongan_pph21',
                'total_diterima',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('rekapitulasi_auditors', function (Blueprint $table) {
            $table->decimal('honor_tahap_1', 15, 2)->default(0)->after('biaya_hotel');
            $table->decimal('honor_tahap_2', 15, 2)->default(0)->after('honor_tahap_1');
            $table->decimal('potongan_pph21', 15, 2)->default(0)->after('honor_tahap_2');
            $table->decimal('total_diterima', 15, 2)->default(0)->after('potongan_pph21');
        });
    }
};
