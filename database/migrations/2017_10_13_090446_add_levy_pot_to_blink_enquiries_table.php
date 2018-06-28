<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevyPotToBlinkEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_organisations', function (Blueprint $table) {
            $table->float('levy_pot')->nullable()->after('legal_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blink_organisations', function ($table) {
            $table->dropColumn('levy_pot');
        });
    }
}
