<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataCentresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_centres', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('add1')->nullable();
			$table->string('add2')->nullable();
			$table->string('add3')->nullable();
			$table->string('add4')->nullable();
			$table->string('add5')->nullable();
			$table->string('post_code', 11)->nullable();
			$table->string('tel', 12)->nullable();
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
		Schema::drop('data_centres');
	}

}
