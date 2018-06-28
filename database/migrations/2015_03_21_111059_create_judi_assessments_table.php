<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJudiAssessmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('judi_assessments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('sector_id')->unsigned();
			$table->integer('assessor_id')->unsigned();
			$table->date('assessment_date');
			$table->integer('process_id')->unsigned();
			$table->text('entry', 65535)->nullable();
			$table->text('notes', 65535)->nullable();
			$table->integer('cancellation_id')->unsigned()->nullable();
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
		Schema::drop('judi_assessments');
	}

}
