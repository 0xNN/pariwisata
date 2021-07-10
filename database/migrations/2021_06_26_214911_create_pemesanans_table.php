<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan');
            $table->smallInteger('user_id');
            $table->smallInteger('paket_id');
            $table->integer('pax')->nullable();
            $table->date('tgl_pemesanan');
            $table->text('lokasi_jemput');
            $table->string('no_hp');
            $table->integer('jadwal_id');
            $table->integer('status')->default(0); //0 = belum selesai, 1 = selesai, 2 = batal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
}
