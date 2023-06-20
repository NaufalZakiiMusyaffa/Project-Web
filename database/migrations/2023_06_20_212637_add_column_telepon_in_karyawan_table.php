<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTeleponInKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function(Blueprint $table)
        {
            $table->string('telepon')->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('karyawan', 'telepon')) {
            Schema::table('karyawan', function(Blueprint $table)
            {
                $table->dropColumn('telepon');
            });
        }
    }
}
