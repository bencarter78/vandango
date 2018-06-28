<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEdrsNumberToBlinkOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_organisations', function (Blueprint $table) {
            $table->string('edrs')->nullable()->after('hq_id');
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
            $table->dropColumn('edrs');
        });
    }
}
