<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMaterialAndNEw extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 
		Schema::table('material', function($table){ 
			$table->dropForeign('material_projectid_foreign');
			$table->dropColumn('projectid');
			$table->dropColumn('quantity');
			$table->integer('organizationid')->unsigned(); 
			$table->foreign('organizationid')->references('id')->on('organization')->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
