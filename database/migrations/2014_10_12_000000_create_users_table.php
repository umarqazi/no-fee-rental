<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->unique()->nullable();
			$table->integer('user_type')->nullable();
			$table->string('profile_image')->nullable();
			$table->string('phone_number')->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->boolean('status')->default(0)->nullable();
			$table->string('password')->nullable();
            $table->string('neighbourhood_expertise')->nullable();
            $table->string('languages')->nullable();
            $table->string('license_number')->unique()->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
