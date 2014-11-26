<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('UserTableSeeder'); 
	}

}


class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuario')->delete();

        $usuarios = array(
	        	 		array(
			        		'nombres' => 'Daniel Pechán',
			        		'apellidos' => 'León Ortega',
			        		'mail' => 'danielPechan@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	),
			        	array(
			        		'nombres' => 'Ramiro Josimar',
			        		'apellidos' => 'Jiménez Jiménez',
			        		'mail' => 'ramirojosimar@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	),
			        	array(
			        		'nombres' => 'Manuel Alberto',
			        		'apellidos' => 'Cartuche Flores',
			        		'mail' => 'macartuche@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	)
        	);

		DB::table('usuario')->insert( $usuarios );
    }

}