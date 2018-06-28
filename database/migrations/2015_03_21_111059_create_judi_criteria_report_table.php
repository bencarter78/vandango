<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJudiCriteriaReportTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judi_criteria_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('criteria_id')->unsigned()->references('id')->on('judi_criteria')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->integer('report_id')->unsigned()->references('id')->on('judi_reports')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->integer('order')->unsigned()->nullable();
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
        Schema::drop('judi_criteria_report');
    }

}
