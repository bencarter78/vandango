<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelIdToBlinkVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_vacancies', function (Blueprint $table) {
            $table->unsignedInteger('level_id')->nullable()->references('id')->on('qualification_levels')->after('level');
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
            $table->dropColumn('level_id');
        });
    }
}
