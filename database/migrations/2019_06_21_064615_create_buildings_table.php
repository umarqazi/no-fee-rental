<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBuildingsTable
 */
class CreateBuildingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('contact_representative')->nullable();
            $table->unsignedInteger('neighborhood_id')->nullable();
            $table->string('address');
            $table->string('thumbnail');
            $table->enum('building_action', ['OO', 'AA'])->default('AA')->comment = 'Owner Only(OO), Allow Agent(AA)';
            $table->enum('type', ['no fee', 'fee'])->default('no fee');
            $table->boolean('is_verified')->default(false);
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
        Schema::dropIfExists('buildings');
    }
}
