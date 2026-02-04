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
             // Menambahkan kolom mandays setelah kolom jumlah_audit
            $table->integer('mandays')->default(0)->after('jumlah_audit'); 
        });
    }

    public function down(): void
    {
        Schema::table('pelaku_usahas', function (Blueprint $table) {
            $table->dropColumn('mandays');
        });
    }
};
