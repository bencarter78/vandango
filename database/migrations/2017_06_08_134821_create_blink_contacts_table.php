<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlinkContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id');
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('job_title')->nullable();
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
        Schema::dropIfExists('blink_contacts');
    }
}
