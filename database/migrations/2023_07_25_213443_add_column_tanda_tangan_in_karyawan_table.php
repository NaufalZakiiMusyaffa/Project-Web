<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTandaTanganInKaryawanTable extends Migration
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
            $table->string('tanda_tangan')->nullable()->after('telepon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('karyawan', 'tanda_tangan')) {
            Schema::table('karyawan', function(Blueprint $table)
            {
                $table->dropColumn('tanda_tangan');
            });
        }
    }
}
