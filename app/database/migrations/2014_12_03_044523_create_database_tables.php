<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rol', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombres', 45)->unique();
			$table->string('descripcion', 45); 
			$table->timestamps();
		});

		Schema::create('users', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('lastname', 100);
			$table->string('mail', 45)->unique();
			$table->string('password', 100);
			$table->string('direction', 100);
			$table->string('avatar', 100);
			$table->string('remember_token',200);
			$table->timestamps();
		});

		
			//user belongs many roles
		Schema::create ('belongsTo', function ($table)
		{
			$table->increments('id');
			$table->integer('userid')->unsigned();
			$table->integer('rolid')->unsigned();
			$table->timestamps();
			$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('rolid')->references('id')->on('rol')->onDelete('cascade');

		});


		Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100); 
			$table->timestamps();
		});


			//user is member of
		Schema::create('memberof', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usersid')->unsigned();
			$table->integer('teamid')->unsigned();
			$table->timestamps();
			$table->foreign('usersid')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('teamid')->references('id')->on('teams')->onDelete('cascade');

		});	

		Schema::create('organization',function($table){
			$table->increments('id');
			$table->string('name'); 
			$table->string('logo');
			$table->string('address');
			$table->string('webPage');
			$table->timestamps();
		});

		Schema::create('project',function($table){
			$table->increments('id');
			$table->string('teams');
			$table->date('startDate');
			$table->date('endDate');
			$table->decimal('budgetSummary',5,2);
			$table->decimal('budgetEstimated',5,2);
			$table->string('observation',250); 
			$table->integer('organizationid')->unsigned();
			$table->timestamps(); 
			$table->foreign('organizationid')->references('id')->on('organization')->onDelete('cascade');
		});




		Schema::create('material', function($table){
			$table->increments('id');
			$table->string('name');
			$table->decimal('quantity',5,2);
			$table->decimal('value',5,2);
			$table->integer('projectid')->unsigned();
			$table->timestamps();
			$table->foreign('projectid')->references('id')->on('project')->onDelete('cascade');
		});


		Schema::create('iterations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->date('start');
			$table->date('end');
			$table->integer('summaryPoints');
			$table->decimal('summaryBudgets', 6,4);
			$table->decimal('realBudget', 6, 4); 
			$table->integer('projectid')->unsigned();
			$table->timestamps();
			$table->foreign('projectid')->references('id')->on('project')->onDelete('cascade');

		});


		Schema::create('aditionalSpent', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description', 250);
			$table->decimal('value',6,4);
			$table->integer('iterationid')->unsigned(); 
			$table->timestamps();
			$table->foreign('iterationid')->references('id')->on('iterations')->onDelete('cascade');

		});
		
		Schema::create('category', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250); 
			$table->integer('parent')->unsigned();
			$table->timestamps(); 
			$table->foreign('parent')->references('id')->on('category')->onDelete('cascade');

		});


		Schema::create('issue', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('summary', 500);
			$table->string('detail', 500); 
			$table->decimal('budget',6,4); 
			$table->string('currentState',20);
			$table->integer('points'); 
			$table->string('labels', 250);
			$table->integer('iterationid')->unsigned();
			$table->integer('categoryid')->unsigned();
			$table->timestamps();
			$table->foreign('iterationid')->references('id')->on('iterations')->onDelete('cascade');
			$table->foreign('categoryid')->references('id')->on('category')->onDelete('cascade');

		});


		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('comment', 250); 
			$table->date('commentDate');  
			$table->integer('issueid')->unsigned();
			$table->integer('userid')->unsigned();
			$table->timestamps();
			$table->foreign('issueid')->references('id')->on('issue')->onDelete('cascade');
			$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

		});


		Schema::create('scrumStates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);   
			$table->timestamps();
		});


		Schema::create('task', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250); 
			$table->string('summary', 250);  
			$table->integer('points');  
			$table->string('timeEstimated', 100);
			$table->string('timeRemaining', 100); 
			$table->integer('scrumid')->unsigned();  
			$table->integer('issueid')->unsigned();
			$table->integer('userid')->unsigned(); 
			$table->timestamps();
			$table->foreign('scrumid')->references('id')->on('scrumStates')->onDelete('cascade');
			$table->foreign('issueid')->references('id')->on('issue')->onDelete('cascade');
			$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

		});

		Schema::create('personalType',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('test');
			$table->string('description');
			$table->decimal('hourCost',5,2);
			$table->timestamps();
		});

			//issue o history has assigned personal
		Schema::create('assigned', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('personlTypeid')->unsigned();  
			$table->Integer('quantity');    
			$table->decimal('total',6,4);
			$table->timestamps();
			$table->foreign('personlTypeid')->references('id')->on('personalType')->onDelete('cascade');

		});

			//issue o history used material
		Schema::create('used', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('materialid')->unsigned();  
			$table->Integer('quantity');    
			$table->decimal('total',6,4);
			$table->timestamps();
			$table->foreign('materialid')->references('id')->on('material')->onDelete('cascade');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('teams');
		Schema::dropIfExists('rol');

			//users with rol & teams
		Schema::dropIfExists('memberof');
		Schema::dropIfExists('belongsTo');

		Schema::dropIfExists('organization');
		Schema::dropIfExists('project');

		Schema::dropIfExists('iterations'); 
		Schema::dropIfExists('issue');
		Schema::dropIfExists('aditionalSpent');
		Schema::dropIfExists('comments'); 
		Schema::dropIfExists('category'); 
		Schema::dropIfExists('task'); 
		Schema::dropIfExists('material');  
		Schema::dropIfExists('scrumStates'); 
		Schema::dropIfExists('personalType');
		
			//history-issue used material and 
			//issue has assigned personal
		Schema::dropIfExists('used');
		Schema::dropIfExists('assigned');
	}

}
