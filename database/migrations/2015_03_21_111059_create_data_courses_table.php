<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sector_id')->nullable();
			$table->string('title')->nullable();
			$table->string('fwk_code', 45)->nullable();
			$table->integer('value')->nullable();
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
		Schema::drop('data_courses');
	}

}
