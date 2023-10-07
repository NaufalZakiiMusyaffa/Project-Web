<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeJumlahAsetColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aset', function(Blueprint $table)
        {
            $table->dropColumn('jumlah_aset');
            $table->enum('status_aset', ['Sedang dipinjam', 'Siap digunakan', 'Diinventariskan', 'Rusak(Bisa diperbaiki)', 'Sedang diperbaiki', 'Rusak Total'])->after('merk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('aset', 'status_aset')) {
            Schema::table('aset', function(Blueprint $table)
            {
                $table->dropColumn('status_aset');
            });
        }
    }
}
