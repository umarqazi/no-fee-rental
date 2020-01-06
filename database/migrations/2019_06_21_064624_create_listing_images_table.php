<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateListingImagesTable
 */
class CreateListingImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('listing_images', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('listing_id');
			$table->string('listing_image');
			$table->timestamps();

			$table->foreign('listing_id')->references('id')->on('listings');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('listing_images');
	}
}
