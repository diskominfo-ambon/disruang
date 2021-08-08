<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomHasParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_has_participants', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('phone_number');
          $table->string('signature')->nullable();
          $table->string('email')->unique()->nullable();
          $table->timestamp('email_verified_at')->nullable();

          // is ASN
          $table->string('origin')->nullable();
          $table->string('origin_job_title')->nullable();

          // foreign
          $table->foreignId('schedule_id')
            ->onDelete('cascade');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
