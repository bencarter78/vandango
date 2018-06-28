<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrameworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nas_frameworks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('full_name');
            $table->string('short_name');
            $table->string('occupation_code');
            $table->string('occupation_full_name');
            $table->string('occupation_short_name');
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
        Schema::dropIfExists('nas_frameworks');
    }
}
