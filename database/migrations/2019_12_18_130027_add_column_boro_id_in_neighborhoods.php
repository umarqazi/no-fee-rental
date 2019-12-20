<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBoroIdInNeighborhoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->unsignedInteger('boro_id')->after('id');
            $table->foreign('boro_id')->references('id')->on('boroughs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('neighborhoods', function (Blueprint $table) {
            $table->dropColumn('boro_id')->after('id');
        });
    }
}
