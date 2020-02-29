<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateListingsTable
 */
class CreateListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_slug')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('building_id')->nullable();
            $table->unsignedInteger('neighborhood_id')->nullable();
            $table->string('realty_id')->nullable();
            $table->string('realty_url')->nullable();
			$table->string('street_address')->nullable();
			$table->string('display_address')->nullable();
			$table->string('thumbnail')->nullable();
			$table->integer('baths')->nullable();
			$table->float('bedrooms')->nullable();
			$table->string('unit')->nullable();
			$table->integer('rent')->nullable();
			$table->integer('square_feet')->nullable();
			$table->text('description')->nullable();
			$table->string('map_location')->nullable();
            $table->string('lease_term')->nullable();
            $table->string('free_months')->nullable();
            $table->string('application_fee')->nullable();
            $table->string('deposit')->nullable();
            $table->string('renter_rebate')->nullable();
            $table->integer('freshness_score')->nullable();
            $table->enum('listing_type', ['open', 'exclusive'])->default('open')->nullable();
            $table->integer('is_convertible')->default(0)->comment = "0-Not Convertible, 1-Convertible";
			$table->integer('is_featured')->default(0)->comment = "0-Non-Featured, 1-Featured, 2-Request-Featured";
            $table->integer('visibility')->default(2)->comment = "0-Inactive, 1-Active, 2-Pending, 3-Archived";
            $table->integer('availability_type')->nullable()->comment = "0-Not Available, 1-Immediately Available, 2-Available By Date";
            $table->string('availability')->nullable();
            $table->timestamp('expire_on');
			$table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('building_id')->references('id')->on('buildings');
			$table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
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
