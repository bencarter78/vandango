<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWithdrawalIdToBlinkApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_applicants', function (Blueprint $table) {
            $table->integer('withdrawal_id')->nullable()->references('id')->on('apply_withdrawals')->after('contact_surname');
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
            $table->dropColumn('withdrawal_id');
        });
    }
}
