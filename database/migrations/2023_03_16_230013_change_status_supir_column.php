<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusSupirColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supir', function(Blueprint $table)
        {
            $table->dropColumn('status_supir');
        });

        Schema::table('supir', function(Blueprint $table)
        {
            $table->enum('status_supir', ['Siap', 'Sedang Bertugas'])->after('kontak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('supir', 'status_supir')) {
            Schema::table('supir', function(Blueprint $table)
            {
                $table->dropColumn('status_supir');
            });
        }
    }
}
