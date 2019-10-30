<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCalendarEventsTable
 */
class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to')->nullable();
            $table->unsignedInteger('linked_id')->nullable();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('events');
    }
}