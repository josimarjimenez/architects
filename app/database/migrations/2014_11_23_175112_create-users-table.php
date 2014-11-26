<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
       {
			$table->increments('id');
			$table->string('nombres', 100);
			$table->string('apellidos', 100);
			$table->string('mail', 50)->unique();
			$table->string('password', 64);
			$table->string('direccion', 100);
			$table->string('avatar', 100);
			$table->string('remember_token',200);
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
		 Schema::drop('usuario');
	}

}
