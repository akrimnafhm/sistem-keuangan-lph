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
        Schema::create('pelaku_usahas', function (Blueprint $table) {
            $table->id(); // Kunci utama (Primary Key)
            $table->string('no_sttd')->unique();
            $table->string('nama_usaha');
            $table->text('alamat_lengkap');
            $table->string('daerah');
            $table->string('skala_usaha');
            $table->string('jenis_produk');
            $table->integer('jumlah_produk');
            $table->decimal('biaya', 15, 2); 
            $table->integer('jumlah_audit');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4'; $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaku_usahas');
    }
};
