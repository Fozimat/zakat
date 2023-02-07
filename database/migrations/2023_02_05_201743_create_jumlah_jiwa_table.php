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
        Schema::create('jumlah_jiwa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zakat_id');
            $table->string('nama');
            $table->timestamps();
            $table->foreign('zakat_id')->on('zakat')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jumlah_jiwa');
    }
};
