<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnUserIdAndKategoriIdInHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('history', 'user_id')) {
            Schema::table('history', function(Blueprint $table)
            {
                $table->dropForeign('history_user_id_foreign');
                $table->dropColumn('user_id');
            });
        }
        
        if (Schema::hasColumn('history', 'kategori_id')) {
            Schema::table('history', function(Blueprint $table)
            {
                $table->dropForeign('history_kategori_id_foreign');
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
