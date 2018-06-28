<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJudiProcessUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('judi_process_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('process_id')->unsigned()->references('id')->on('judi_processes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->integer('user_id')->unsigned()->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::drop('judi_process_user');
	}

}
