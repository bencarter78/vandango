<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJudiSummariesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judi_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id');
            $table->integer('report_id');
            $table->integer('grade_id');
            $table->text('summary')->nullable();
            $table->date('assessment_date')->nullable();
            $table->text('document_path', 65535)->nullable();
            $table->string('outcome')->nullable();
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
        Schema::drop('judi_summaries');
    }

}
