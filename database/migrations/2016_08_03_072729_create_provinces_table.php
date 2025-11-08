<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('laravolt.indonesia.table_prefix').'provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code', 2)->unique();
            $table->string('name', 255);
            $table->bigInteger('transport_dalam_kota')->default(0);
            $table->bigInteger('uhpd_dalam_kota')->default(0);
            $table->bigInteger('hotel_luar_kota')->default(0);
            $table->bigInteger('transport_luar_kota')->default(0);
            $table->bigInteger('tiket_pesawat_luar_kota')->default(0);
            $table->bigInteger('uhpd_luar_kota')->default(0);
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4'; $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('laravolt.indonesia.table_prefix').'provinces');
    }
}
