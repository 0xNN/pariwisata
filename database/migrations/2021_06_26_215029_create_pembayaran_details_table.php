<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_details', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('pembayaran_id');
            $table->integer('pembayaran_ke');
            $table->bigInteger('dibayar')->nullable();
            $table->smallInteger('bank_id')->nullable();
            $table->string('no_rekening')->nullable();
            $table->text('bukti_bayar')->nullable();
            $table->smallInteger('status_dibayar')->default(0); // 0 = belum, 1 = sudah
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
        Schema::dropIfExists('pembayaran_details');
    }
}
