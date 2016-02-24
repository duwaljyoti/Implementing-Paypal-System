<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookissuedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booksissued', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->decimal('book_id');
			$table->string('student_name');
			$table->decimal('returned');
			$table->date('issued_date');
			$table->date('to_return_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('booksissued', function(Blueprint $table)
		{
			//
		});
	}

}
