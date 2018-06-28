<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkRejectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_rejections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vacancy_id')->references('id')->on('blink_vacancies');
            $table->integer('rejection_type_id')->references('id')->on('blink_rejection_types')->nullable();
            $table->integer('rejected_by')->references('id')->on('users');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blink_rejections');
    }
}
