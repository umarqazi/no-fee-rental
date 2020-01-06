<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNeighborhoodsTable
 */
class CreateNeighborhoodsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('boro_id');
            $table->string('name');
            $table->string('banner')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('boro_id')->references('id')->on('boroughs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('neighborhoods');
    }
}
