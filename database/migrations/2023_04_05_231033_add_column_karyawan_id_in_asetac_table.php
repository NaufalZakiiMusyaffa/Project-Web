<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKaryawanIdInAsetacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asetac', function(Blueprint $table)
        {
            $table->integer('karyawan_id')->unsigned()->nullable()->after('status_kendaraan');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('asetac', 'karyawan_id')) {
            Schema::table('asetac', function(Blueprint $table)
            {
                $table->dropForeign('asetac_karyawan_id_foreign');
                $table->dropColumn('karyawan_id');
            });
        }
    }
}
