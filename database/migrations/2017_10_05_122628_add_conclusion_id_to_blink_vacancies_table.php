<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConclusionIdToBlinkVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_vacancies', function (Blueprint $table) {
            $table->integer('conclusion_id')->references('id')->nullable()->on('blink_conclusions')->after('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blink_vacancies', function ($table) {
            $table->dropColumn('conclusion_id');
        });
    }
}
