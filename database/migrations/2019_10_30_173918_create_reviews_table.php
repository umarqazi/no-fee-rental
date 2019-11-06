<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReviewsTable
 */
class CreateReviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('review_for');
            $table->unsignedInteger('review_from');
            $table->integer('rating')->nullable();
            $table->text('request_message');
            $table->text('review_message')->nullable();
            $table->string('token', 60);
            $table->integer('is_token_used');
            $table->timestamps();

            $table->foreign('review_for')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('review_from')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reviews');
    }
}
