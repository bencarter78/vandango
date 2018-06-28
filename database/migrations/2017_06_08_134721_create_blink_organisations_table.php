<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('datastore_ref')->nullable();
            $table->integer('employee_count')->nullable();
            $table->integer('site_count')->nullable();
            $table->string('legal_status')->nullable();
            $table->integer('hq_id')->references('id')->on('locations')->nullable();
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
        Schema::dropIfExists('blink_organisations');
    }
}
