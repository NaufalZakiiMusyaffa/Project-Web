<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAsetIdAndKaryawanIdToHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history', function(Blueprint $table)
        {
            $table->integer('aset_id')->unsigned()->after('tgl_history');
            $table->foreign('aset_id')->references('id')->on('aset')->onDelete('cascade');
            $table->integer('karyawan_id')->unsigned()->after('tindakan');
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
        if (Schema::hasColumn('history', 'aset_id')) {
            Schema::table('history', function(Blueprint $table)
            {
                $table->dropForeign('history_aset_id_foreign');
                $table->dropColumn('aset_id');
            });
        }
        
        if (Schema::hasColumn('history', 'karyawan_id')) {
            Schema::table('history', function(Blueprint $table)
            {
                $table->dropForeign('history_karyawan_id_foreign');
                $table->dropColumn('karyawan_id');
            });
        }
    }
}
