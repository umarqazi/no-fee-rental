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
            $table->unsignedInteger('ref_event_id')->nullable();
            $table->string('model')->nullable();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users');
            $table->foreign('from')->references('id')->on('users');
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
