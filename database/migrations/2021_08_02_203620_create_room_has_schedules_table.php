<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomHasSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_has_schedules', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->string('slug')->nullable();
          $table->text('desc')->nullable();
          $table->datetime('started_at');
          $table->datetime('ended_at');
          $table->boolean('is_active')->default(true);
          $table->enum('status', ['pending', 'confirm', 'reject'])->default('pending');

          // foreign key
          $table->foreignId('room_id')
            ->constrained()
            ->onDelete('cascade');

          $table->foreignId('user_id')
            ->constrained()
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
        Schema::dropIfExists('schedule_has_rooms');
    }
}
