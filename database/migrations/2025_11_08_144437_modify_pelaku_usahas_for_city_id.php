<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE pelaku_usahas ENGINE = InnoDB');
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            $table->dropColumn('daerah');
            $table->char('city_id', 4)->nullable()->after('alamat_lengkap')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            
            // Baris ini sudah 100% BENAR
            $table->foreign('city_id')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            // Kita perlu mengambil nama tabel yang benar di sini juga
            $tableName = config('laravolt.indonesia.table_prefix') . 'cities';
            
            // Perbaikan kecil untuk method down() agar lebih aman
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->string('daerah');
        });
    }
};