<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKaryawanIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('karyawan_id')->unsigned()->nullable()->after('id');
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
        if (Schema::hasColumn('users', 'karyawan_id')) {
            Schema::table('users', function(Blueprint $table)
            {
                $table->dropForeign('users_karyawan_id_foreign');
                $table->dropColumn('karyawan_id');
            });
        }
    }
}
