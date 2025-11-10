<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nama tabel 'provinces' mungkin memiliki prefix
        // Kita ambil nama tabelnya dari config
        $tableName = config('laravolt.indonesia.table_prefix') . 'provinces';

        Schema::table($tableName, function (Blueprint $table) {
            $table->decimal('transport_dalam_kota', 15, 2)->default(0)->after('meta');
            $table->decimal('uhpd_dalam_kota', 15, 2)->default(0)->after('transport_dalam_kota');
            $table->decimal('hotel_luar_kota', 15, 2)->default(0)->after('uhpd_dalam_kota');
            $table->decimal('transport_luar_kota', 15, 2)->default(0)->after('hotel_luar_kota');
            $table->decimal('tiket_pesawat_luar_kota', 15, 2)->default(0)->after('transport_luar_kota');
            $table->decimal('uhpd_luar_kota', 15, 2)->default(0)->after('tiket_pesawat_luar_kota');
        });
    }

    public function down(): void
    {
        $tableName = config('laravolt.indonesia.table_prefix') . 'provinces';

        Schema::table($tableName, function (Blueprint $table) {
            $table->dropColumn([
                'transport_dalam_kota',
                'uhpd_dalam_kota',
                'hotel_luar_kota',
                'transport_luar_kota',
                'tiket_pesawat_luar_kota',
                'uhpd_luar_kota'
            ]);
        });
    }
};