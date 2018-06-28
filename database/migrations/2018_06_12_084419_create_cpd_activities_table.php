<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpdActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpd_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->unsignedInteger('timetable_id')->nullable()->references('id')->on('classroom_timetable');
            $table->string('title');
            $table->date('starts_on');
            $table->date('ends_on');
            $table->date('completed_on')->nullable();
            $table->unsignedInteger('total_hours')->nullable();
            $table->unsignedInteger('deliverer_id');
            $table->unsignedInteger('grade_id')->nullable();
            $table->text('reflection')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('cpd_activities');
    }
}
