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
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            // Hapus kolom 'daerah' yang lama (bertipe string)
            $table->dropColumn('daerah');
            
            // Tambahkan kolom 'wilayah_id' yang baru (bertipe foreign key)
            // 'nullable()' untuk menghindari error
            // 'after()' agar posisi kolomnya rapi setelah alamat_lengkap
            // 'constrained()' untuk membuat relasi ke tabel 'wilayahs'
            $table->foreignId('wilayah_id')->nullable()->after('alamat_lengkap')->constrained('wilayahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            $table->dropForeign(['wilayah_id']);
            $table->dropColumn('wilayah_id');
            $table->string('daerah')->after('alamat_lengkap');
        });
    }
};
