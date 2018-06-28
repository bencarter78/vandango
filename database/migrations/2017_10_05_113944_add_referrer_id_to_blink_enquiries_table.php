<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferrerIdToBlinkEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_enquiries', function (Blueprint $table) {
            $table->integer('referrer_id')->references('id')->nullable()->on('blink_referrers')->after('location');
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
            $table->dropColumn('referrer_id');
        });
    }
}
