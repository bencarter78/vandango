<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnquiryIdToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_applicants', function (Blueprint $table) {
            $table->integer('enquiry_id')->refernces('id')->on('blink_enquiries')->nullable()->after('id');
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
            $table->dropColumn('enquiry_id');
        });
    }
}
