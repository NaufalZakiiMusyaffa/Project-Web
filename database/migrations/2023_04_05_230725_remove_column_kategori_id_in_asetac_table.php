<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnKategoriIdInAsetacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('asetac', 'kategori_id')) {
            Schema::table('asetac', function(Blueprint $table)
            {
                $table->dropForeign('asetac_kategori_id_foreign');
                $table->dropColumn('kategori_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
