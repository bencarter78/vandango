<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->default('');
            $table->string('aim_ref')->nullable();
            $table->integer('course_type_id')->references('id')->on('classroom_course_types');
            $table->boolean('is_mandatory')->default(0);
            $table->boolean('is_agreement_required')->default(1);
            $table->decimal('cost', 7, 2)->default(0);
            $table->string('resource_url')->nullable();
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
        Schema::dropIfExists('classroom_courses');
    }
}
