<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_aset');
            $table->string('nama_aset');
            $table->integer('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('merk')->nullable();
            $table->integer('jumlah_aset');
            $table->text('spesifikasi')->nullable();
            $table->date('garansi');
            $table->date('tgl_beli');
            $table->integer('harga_beli')->nullable();
            $table->string('toko_beli')->nullable();
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
        Schema::dropIfExists('aset');
    }
}
