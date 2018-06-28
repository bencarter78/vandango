<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJudiSectorScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('judi_sector_schedule', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sector_id')->unsigned()->references('id')->on('data_sectors')->onUpdate('RESTRICT')->onDelete('CASCADE');;
			$table->integer('month')->unsigned();
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
		Schema::drop('judi_sector_schedule');
	}

}
