<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zakat', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jumlah_jiwa')->nullable();
            $table->string('zakat_fitrah_uang')->nullable();
            $table->string('zakat_fitrah_beras')->nullable();
            $table->string('zakat_mal')->nullable();
            $table->string('infaq')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zakat');
    }
};
