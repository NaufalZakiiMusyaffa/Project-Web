<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGambarInKaryawanTable extends Migration
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
            $table->string('gambar')->nullable()->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('karyawan', 'gambar')) {
            Schema::table('karyawan', function(Blueprint $table)
            {
                $table->dropColumn('gambar');
            });
        }
    }
}
