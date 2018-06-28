<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgrammeTypeToBlinkOpportunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_opportunities', function (Blueprint $table) {
            $table->string('programme_type')->nullable()->after('expected_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blink_opportunities', function ($table) {
            $table->dropColumn('programme_type');
        });
    }
}
