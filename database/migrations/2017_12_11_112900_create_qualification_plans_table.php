<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sector_id')->unsigned()->references('id')->on('data_sectors');
            $table->string('code');
            $table->string('description');
            $table->string('framework');
            $table->string('framework_path');
            $table->string('main_aim');
            $table->string('main_aim_description');
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
        Schema::dropIfExists('qualification_plans');
    }
}
