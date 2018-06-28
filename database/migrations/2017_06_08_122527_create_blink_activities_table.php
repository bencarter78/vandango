<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlinkActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blink_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('owner');
            $table->integer('assigned_by')->references('id')->on('users')->nullable();
            $table->integer('assigned_to')->references('id')->on('users')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->text('note');
            $table->integer('updated_by')->references('id')->on('users')->nullable();
            $table->boolean('is_complete')->default(1);
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
        Schema::dropIfExists('blink_activities');
    }
}
