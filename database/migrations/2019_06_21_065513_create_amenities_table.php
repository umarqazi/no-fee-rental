<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('amenities', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('listing_id');
			$table->string('amenity');

			$table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onEdit('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('amenities');
	}
}
