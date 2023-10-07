<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_transaksi');
            $table->integer('karyawan_id')->unsigned();
            $table->integer('aset_id')->unsigned();
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['pinjam', 'kembali']);
            $table->text('ket')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
