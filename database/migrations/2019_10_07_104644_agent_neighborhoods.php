<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AgentNeighborhoods
 */
class AgentNeighborhoods extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('agent_neighborhoods', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('neighborhood_id');

            $table->foreign('agent_id')->references('id')->on('users');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('agent_neighborhoods');
    }
}
