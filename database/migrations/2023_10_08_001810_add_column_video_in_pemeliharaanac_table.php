<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVideoInPemeliharaanacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemeliharaanac', function (Blueprint $table) {
            $table->string('video')->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('pemeliharaanac', 'video')) {
            Schema::table('pemeliharaanac', function (Blueprint $table) {
                $table->dropColumn('video');
            });
        }
    }
}
