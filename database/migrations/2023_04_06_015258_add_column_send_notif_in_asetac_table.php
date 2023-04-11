<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSendNotifInAsetacTable extends Migration
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
            $table->boolean('send_notif')->default(0)->after('karyawan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('asetac', 'send_notif')) {
            Schema::table('asetac', function(Blueprint $table)
            {
                $table->dropColumn('send_notif');
            });
        }
    }
}
