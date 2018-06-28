<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysafeKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keysafe_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('ident')->nullable();
            $table->integer('sector_id')->nullable();
            $table->string('first_name');
            $table->string('surname');
            $table->string('email');
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
        Schema::drop('keysafe_keys');
    }
}
