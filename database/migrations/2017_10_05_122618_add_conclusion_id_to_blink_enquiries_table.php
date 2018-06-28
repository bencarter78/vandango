<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConclusionIdToBlinkEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_enquiries', function (Blueprint $table) {
            $table->integer('conclusion_id')->references('id')->nullable()->on('blink_conclusions')->after('referrer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blink_enquiries', function ($table) {
            $table->dropColumn('conclusion_id');
        });
    }
}
