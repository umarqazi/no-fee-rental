<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTypesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('listing_types', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('listing_id');
			$table->integer('property_type')
				->comment = "1-List Type, 2-Pet Policy, 3-Unit Features, 4-Building Features, 5-Amenities";
			$table->string('value');
			$table->timestamps();

			$table->foreign('listing_id')->references('id')->on('listings')->onEdit('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('listing_types');
	}
}
