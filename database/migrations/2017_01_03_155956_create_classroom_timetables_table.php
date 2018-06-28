<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->references('id')->on('classroom_courses');
            $table->integer('room_id')->references('id')->on('classroom_rooms');
            $table->integer('trainer_id')->references('id')->on('users');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_timetables');
    }
}
