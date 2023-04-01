<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusKendaraanColumn extends Migration
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
            $table->dropColumn('status_kendaraan');
        });

        Schema::table('asetac', function(Blueprint $table)
        {
            $table->enum('status_kendaraan', ['Sedang dipinjam', 'Siap Digunakan', 'Digunakan', 'Ada Kerusakan'])->after('masaberlaku_stnk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('asetac', 'status_kendaraan')) {
            Schema::table('asetac', function(Blueprint $table)
            {
                $table->dropColumn('status_kendaraan');
            });
        }
    }
}
