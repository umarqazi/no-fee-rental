<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCreditPlansTable
 */
class CreateCreditPlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('credit_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('remaining_slots');
            $table->string('remaining_repost');
            $table->string('remaining_featured');
            $table->enum('plan', ['basic', 'gold', 'platinum']);
            $table->boolean('is_cancel')->default(false);
            $table->boolean('is_expired')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('credit_plans');
    }
}
