<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEportfolioSectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eportfolio_centre_sector', function (Blueprint $table) {
            $table->unsignedInteger('centre_id')->references('id')->on('eportfolios_centres');
            $table->unsignedInteger('sector_id')->references('id')->on('data_sectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eportfolio_centre_sector');
    }
}
