<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInvitesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('agent_invites', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('invited_by');
			$table->string('email');
			$table->string('token', 60);
            $table->boolean('accept')->nullable();
			$table->timestamps();

			$table->foreign('invited_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('agent_invites');
	}
}
