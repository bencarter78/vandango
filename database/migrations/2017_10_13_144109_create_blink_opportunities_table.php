<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id')->references('id')->on('blink_enquiries');
            $table->integer('user_id')->nullable()->references('id')->on('users');
            $table->integer('sector_id')->nullable()->references('id')->on('data_sectors');
            $table->integer('quantity')->nullable();
            $table->integer('value')->nullable();
            $table->date('expected_on')->nullable();
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
        Schema::dropIfExists('blink_opportunities');
    }
}
