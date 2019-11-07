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
            $table->string('building')->default(str_random(10));
            $table->string('address');
            $table->unsignedInteger('contact_representative')->nullable();
            $table->string('neighborhood')->nullable();
            $table->enum('building_action', ['OO', 'AA'])->nullable()->comment = 'O => Owner Only, A => Allow Agent';
            $table->enum('type', ['no fee', 'fee'])->default('no fee');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contact_representative')->references('id')->on('users')->onDelete('cascade');
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
