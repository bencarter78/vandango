<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLevyPotTypeToIntegerOnBlinkOrganisations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blink_organisations', function (Blueprint $table) {
            $table->integer('levy_pot')->change();
        });
    }
}
