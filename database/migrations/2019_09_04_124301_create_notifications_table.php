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
            $table->unsignedInteger('from')->nullable();
            $table->unsignedInteger('to');
            $table->unsignedInteger('linked_id')->nullable();
            $table->string('model')->nullable();
            $table->text('message');
            $table->text('url');
            $table->boolean('is_read')->default(0)->comment = "0-Unread, 1-Read";
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users');
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
