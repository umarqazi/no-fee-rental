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
            $table->unsignedInteger('user_id')->nullable();
            $table->string('unique_slug')->unique();
            $table->string('realty_id')->nullable();
            $table->unsignedInteger('neighborhood_id')->nullable();
			$table->string('name')->nullable();
            $table->string('email')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('street_address')->nullable();
			$table->string('display_address')->nullable();
			$table->string('thumbnail')->nullable();
			$table->integer('baths')->nullable();
			$table->integer('bedrooms')->nullable();
			$table->string('unit')->nullable();
			$table->integer('rent')->nullable();
			$table->integer('square_feet')->nullable();
			$table->text('description')->nullable();
			$table->string('map_location')->nullable();
			$table->string('realty_url')->nullable();
			$table->enum('building_type', ['open', 'exclusive'])->default('open')->nullable();
			$table->integer('is_featured')->default(0)->comment = "0-Non-Featured, 1-Featured, 2-Request-Featured";
            $table->integer('visibility')->default(2)->comment = "0-Inactive, 1-Active, 2-Pending";
            $table->string('availability')->nullable()->comment = "0-Not Available, 1-Available, 2-Immediately, 3-Date";
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->onDelete('cascade');
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
