<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsReassessmentToJudiAssessments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judi_assessments', function (Blueprint $table) {
            $table->boolean('is_reassessment')->default(0)->after('cancellation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('judi_assessments', function ($table) {
            $table->dropColumn('is_reassessment');
        });
    }
}
