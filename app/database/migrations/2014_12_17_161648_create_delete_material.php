<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeleteMaterial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		//issue o history used material
		Schema::table('used', function(Blueprint $table)
		{ 
			$table->integer('issueid')->unsigned();
			$table->foreign('issueid')->references('id')->on('issue')->onDelete('cascade');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{ 
		Schema::dropIfExists('material');  
	}

}
