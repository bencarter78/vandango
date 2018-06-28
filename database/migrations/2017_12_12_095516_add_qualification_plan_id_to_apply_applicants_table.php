<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQualificationPlanIdToApplyApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_applicants', function (Blueprint $table) {
            $table->integer('qualification_plan_id')->unsigned()->nullable()->references('id')->on('qualification_plans')->after('sector_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_applicants', function ($table) {
            $table->dropColumn('qualification_plan_id');
        });
    }
}
