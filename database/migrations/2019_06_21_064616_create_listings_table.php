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
            $table->string('realty_id')->nullable();
			$table->string('name')->nullable();
            $table->string('email')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('street_address')->nullable();
			$table->string('display_address')->nullable();
			$table->string('neighborhood')->nullable();
			$table->string('thumbnail')->nullable();
			$table->integer('baths')->nullable();
			$table->integer('bedrooms')->nullable();
			$table->integer('unit')->nullable();
			$table->integer('rent')->nullable();
			$table->integer('square_feet')->nullable();
			$table->text('description')->nullable();
			$table->string('map_location')->nullable();
			$table->string('realty_url')->nullable();
			$table->integer('is_featured')->default(0)->comment = "0-Non-Featured, 1-Featured, 2-Request-Featured";
            $table->integer('visibility')->default(2)->comment = "0-Inactive, 1-Active, 2-Pending";
            $table->integer('availability')->default(1)->comment = "0-Not Available, 1-Available";
			$table->string('city_state_zip')->comment = "Any one of 3 given accepted";
            $table->string('open_house')->nullable();
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
