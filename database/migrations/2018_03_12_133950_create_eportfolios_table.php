<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEportfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eportfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id')->references('id')->on('apply_applicants')->unique();
            $table->unsignedInteger('centre_id')->references('id')->on('eportfolios_centres');
            $table->string('name')->nullable();
            $table->string('ref')->nullable();
            $table->string('username')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eportfolios');
    }
}
