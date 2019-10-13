<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building');
            $table->unsignedInteger('apartment_id');
            $table->enum('type', ['no fee', 'fee'])->default('no fee');
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->foreign('apartment_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_buildings');
    }
}
