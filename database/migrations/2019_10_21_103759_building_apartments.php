<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuildingApartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('building_apartments', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('apartment_id');

            $table->foreign('building_id')->references('id')->on('buildings');
            $table->foreign('apartment_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('building_apartments');
    }
}
