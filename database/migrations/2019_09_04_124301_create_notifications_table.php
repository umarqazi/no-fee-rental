<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotificationsTable
 */
class CreateNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->text('message');
            $table->text('url');
            $table->boolean('is_read')->default(0)->comment = "0-Unread, 1-Read";
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifications');
    }
}
