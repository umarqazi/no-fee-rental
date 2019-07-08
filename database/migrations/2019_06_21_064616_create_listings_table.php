<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('listings', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name');
			$table->string('phone_number');
			$table->string('email');
			$table->string('website');
			$table->string('street_address');
			$table->string('display_address');
			$table->string('neighborhood');
			$table->string('thumbnail');
			$table->integer('baths');
			$table->integer('bedrooms');
			$table->integer('unit');
			$table->integer('rent');
			$table->integer('square_feet');
			$table->boolean('available');
			$table->text('description');
			$table->string('map_location')->nullable();
			$table->integer('is_featured')->default(0)->comment = "0-Non-Featured, 1-Featured";
			$table->integer('status')->default(2)->comment = "0-Inactive, 1-Active, 2-Pending";
			$table->string('city_state_zip')->comment = "any one of 3 given accepted";
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onEdit('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('listings');
	}
}
