<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCompaniesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('agent_companies', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('agent_id');
			$table->unsignedInteger('company_id');
			$table->timestamps();

			$table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('agent_companies');
	}
}
