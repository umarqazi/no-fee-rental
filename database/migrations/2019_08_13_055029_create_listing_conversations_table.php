<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateListingConversationsTable
 */
class CreateListingConversationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('listing_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('from')->nullable();
            $table->unsignedInteger('to');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('reply_rate')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_time')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->enum('conversation_type', ['1', '2'])->comment = "1-Appointment, 2-Check Availability";
            $table->boolean('meeting_request')->default(0)->comment = "0-Not Accept Yet, 1-Accepted";
            $table->timestamps();

            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('listing_conversations');
    }
}
