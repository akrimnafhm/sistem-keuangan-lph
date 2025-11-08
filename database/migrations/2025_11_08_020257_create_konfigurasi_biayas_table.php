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
        Schema::create('konfigurasi_biayas', function (Blueprint $table) {
            $table->id();
            
            // Kolom untuk Pajak (angka bulat)
            $table->integer('pajak')->default(11);

            // Kolom untuk Fee UIN (angka bulat besar)
            $table->bigInteger('fee_uin_mikro')->default(300000);
            $table->bigInteger('fee_uin_menengah')->default(1000000);
            $table->bigInteger('fee_uin_besar')->default(2000000);

            // Kolom untuk Fee LPH (angka bulat besar)
            $table->bigInteger('fee_lph_mikro')->default(480000);
            $table->bigInteger('fee_lph_menengah')->default(980000);
            $table->bigInteger('fee_lph_besar')->default(1440000);

            // Kolom untuk % Unit Cost Audit (angka bulat)
            $table->integer('unit_cost_audit_mikro')->default(60);
            $table->integer('unit_cost_audit_menengah')->default(40);
            $table->integer('unit_cost_audit_besar')->default(40);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_biayas');
    }
};