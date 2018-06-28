<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('applicant_ident')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name');
            $table->string('surname');
            $table->integer('sector_id')->references('id')->on('data_sectors');
            $table->string('programme_type')->nullable();
            $table->date('starting_on');
            $table->string('pics_organisation_id')->nullable();
            $table->string('organisation_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_surname')->nullable();
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
        Schema::drop('apply_applicants');
    }
}
