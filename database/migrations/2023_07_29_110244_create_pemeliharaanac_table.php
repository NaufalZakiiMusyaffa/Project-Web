<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemeliharaanacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeliharaanac', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('kode_pemeliharaan');
            $table->integer('asetac_id')->unsigned();
            $table->foreign('asetac_id')->references('id')->on('asetac')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->integer('biaya');
            $table->integer('status');
            $table->string('yang_mengajukan')->nullable();
            $table->string('keputusan_oleh')->nullable();
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('pemeliharaanac');
    }
}
