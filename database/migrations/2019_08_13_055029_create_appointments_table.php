<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->boolean('is_archived')->default(false);
            $table->boolean('meeting_request')->default(0)->comment = "0-Not Accept Yet, 1-Accepted";
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('appointments');
    }
}
