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
        Schema::create('auditors', function (Blueprint $table) {
            $table->id(); // 1. ID
            $table->string('nama'); // 2. Nama
            $table->string('email')->unique(); // 3. Email (Wajib Unique)
            $table->string('nomor_aktif'); // 4. Nomor Aktif (HP/WA)
            $table->string('status')->default('Aktif'); // 5. Status (Aktif/Nonaktif)
            $table->timestamps(); // Menambahkan created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditors');
    }
};