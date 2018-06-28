<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditorTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditor_tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('title')->unique();
            $table->text('description', 65535);
            $table->text('sql', 65535);
            $table->string('group_by')->nullable();
            $table->text('recipients', 65535);
            $table->text('notification', 65535);
            $table->string('run_frequency')->nullable();
            $table->dateTime('ran_at')->nullable();
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
        Schema::drop('auditor_tasks');
    }
}
