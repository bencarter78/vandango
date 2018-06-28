<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id');
            $table->string('location');
            $table->integer('employee_count')->nullable();
            $table->integer('projected_value')->nullable();
            $table->integer('actual_value')->nullable();
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
        Schema::dropIfExists('blink_enquiries');
    }
}
