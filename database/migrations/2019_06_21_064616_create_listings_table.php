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
			$table->string('seller_name');
			$table->string('seller_phone_number');
			$table->string('seller_email');
			$table->string('seller_website');
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
			$table->boolean('status')->default(1);
			$table->string('city_state_zip')->comment = "any one of 3 given accepted";

			$table->timestamps();
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
