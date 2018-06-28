<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sector_id');
            $table->string('type');
            $table->date('framework_expires_on')->nullable();
            $table->string('title');
            $table->string('code');
            $table->text('description');
            $table->unsignedInteger('level');
            $table->string('capability')->nullable();
            $table->unsignedInteger('awarding_body_id')->nullable();
            $table->string('epa_provider');
            $table->string('aim_ref_standard');
            $table->string('aim_ref_mandatory');
            $table->string('aim_ref_optional');
            $table->unsignedInteger('programme_length');
            $table->unsignedInteger('programme_length_adult');
            $table->unsignedInteger('total_training');
            $table->unsignedInteger('total_epa');
            $table->unsignedInteger('total_negotiated');
            $table->unsignedInteger('funding_band');
            $table->unsignedInteger('funding_cap');
            $table->unsignedInteger('co_investment');
            $table->unsignedInteger('employer_contribution');
            $table->unsignedInteger('additional_delivery');
            $table->unsignedInteger('total_contribution');
            $table->unsignedInteger('provider_incentive');
            $table->unsignedInteger('provider_uplift');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('blink_courses');
    }
}
