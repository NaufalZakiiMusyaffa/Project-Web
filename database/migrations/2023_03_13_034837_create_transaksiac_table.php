<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksiac', function (Blueprint $table) {
            $table->increments('id')->nsigned();
            $table->string('kode_peminjaman');
            $table->integer('karyawan_id')->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->integer('asetac_id')->unsigned();
            $table->foreign('asetac_id')->references('id')->on('asetac')->onDelete('cascade');
            $table->integer('supir_id')->unsigned();
            $table->foreign('supir_id')->references('id')->on('supir')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->text('ket');
            $table->enum('status', ['pinjam', 'kembali']);
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
        Schema::dropIfExists('transaksiac');
    }
}
