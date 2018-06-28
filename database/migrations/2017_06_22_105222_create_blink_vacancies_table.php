<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref')->nullable();
            $table->integer('enquiry_id')->unsigned()->nullable();
            $table->integer('contact_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('reo_id')->nullable();
            $table->integer('application_manager_id')->nullable();
            $table->integer('submitted_by')->references('id')->on('users');
            $table->integer('approved_by')->references('id')->on('users')->nullable();
            $table->integer('sla_id')->nullable();
            $table->string('title')->nullable();
            $table->string('framework_id')->nullable();
            $table->string('qual_type')->nullable();
            $table->string('level')->nullable();
            $table->integer('duration')->nullable();
            $table->float('wage')->nullable();
            $table->integer('sector_id')->nullable();
            $table->integer('hours')->nullable();
            $table->text('working_week')->nullable();
            $table->date('closes_on')->nullable();
            $table->date('interviews_on')->nullable();
            $table->date('starts_on')->nullable();
            $table->integer('positions_count')->nullable();
            $table->text('description')->nullable();
            $table->text('required_skills')->nullable();
            $table->text('required_qualifications')->nullable();
            $table->text('personal_qualities')->nullable();
            $table->text('training_provided')->nullable();
            $table->text('future_prospects')->nullable();
            $table->text('considerations')->nullable();
            $table->text('question_1')->nullable();
            $table->text('question_2')->nullable();
            $table->text('filter_applications')->nullable();
            $table->boolean('is_visible')->default(1);
            $table->text('application_route_url')->nullable();
            $table->text('organisation_description')->nullable();
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
        Schema::drop('blink_vacancies');
    }
}
