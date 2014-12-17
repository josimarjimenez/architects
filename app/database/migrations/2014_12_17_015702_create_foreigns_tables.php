<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				//teams y projects
		Schema::create('workIn',function($table){
			$table->increments('id');
			$table->integer('projectid')->unsigned();
			$table->integer('teamsid')->unsigned();
			$table->timestamps(); 
			$table->foreign('projectid')->references('id')->on('project')->onDelete('cascade');
			$table->foreign('teamsid')->references('id')->on('teams')->onDelete('cascade');
		});

		//organization with users
		Schema::create('integrates',function($table){
			$table->increments('id');
			$table->integer('organizationid')->unsigned();
			$table->integer('usersid')->unsigned();
			$table->timestamps(); 
			$table->foreign('organizationid')->references('id')->on('organization')->onDelete('cascade');
			$table->foreign('usersid')->references('id')->on('users')->onDelete('cascade');
		});


		//organization add column usersid
		Schema::table('organization',function($table){
			$table->integer('usersid')->unsigned(); 
			$table->foreign('usersid')->references('id')->on('users')->onDelete('cascade');
		});

		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::dropIfExists('workIn');
		Schema::dropIfExists('integrates'); 

	}

}
