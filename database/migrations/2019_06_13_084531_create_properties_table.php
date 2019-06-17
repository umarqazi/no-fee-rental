<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('phone_number');
            $table->string('email');
            $table->string('website');
            $table->string('street_address');
            $table->string('city');
            $table->string('display_address');
            $table->string('neighborhood');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->string('unit');
            $table->string('rent');
            $table->string('square_feet');
            $table->string('available');
            $table->longText('description');
            $table->string('listing_type');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
