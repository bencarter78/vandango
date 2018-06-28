<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_cohorts', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('attendee');
            $table->integer('timetable_id')->references('id')->on('classroom_timetables');
            $table->boolean('attended')->nullable();
            $table->decimal('cost', 7, 2)->default(0);
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
        Schema::dropIfExists('classroom_cohorts');
    }
}
