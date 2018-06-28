<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEpisodeIdentToApplyApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_applicants', function (Blueprint $table) {
            $table->string('episode_ident')->nullable()->after('applicant_ident');
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
            $table->dropColumn('episode_ident');
        });
    }
}
