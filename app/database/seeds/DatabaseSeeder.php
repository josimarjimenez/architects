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
		 $this->call('OrganizationTableSeeder'); 
		 $this->call('ProjectsTableSeeder');
	}

}


//usuarios
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
	        	 		array(
			        		'name' => 'Daniel Pechán',
			        		'lastname' => 'León Ortega',
			        		'mail' => 'danielPechan@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	),
			        	array(
			        		'name' => 'Ramiro Josimar',
			        		'lastname' => 'Jiménez Jiménez',
			        		'mail' => 'ramirojosimar@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	),
			        	array(
			        		'name' => 'Manuel Alberto',
			        		'lastname' => 'Cartuche Flores',
			        		'mail' => 'macartuche@gmail.com' ,
			        		'password' => Hash::make('admin')
			        	)
        	);

		DB::table('users')->insert( $users );
    }
}


//organizacinoes
class OrganizationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('organization')->delete();

        $organizations = array(
	        	 		array(
			        		'name' => 'Unesco',
			        		'address' => 'S/N',
			        		'webPage' => 'http://es.unesco.org/',
			        		'usersid' => 1
			        	),
			        	array(
			        		'name' => 'Yahoo',
			        		'address' => 'S/N',
			        		'webPage' => 'https://es.yahoo.com',
			        		'usersid' => 1
			        	),
			        	array(
			        		'name' => 'Kalvin Klein',
			        		'address' => 'S/N',
			        		'webPage' => 'http://explore.calvinklein.com',
			        		'usersid' => 2 
			        	),
			        	 
        	);

		DB::table('organization')->insert( $organizations );
    }
}


//projectos
class ProjectsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('project')->delete();

        $projects = array(
	        	 		array(
			        		'name' => 'Construcción de vía',
			        		'startDate' => '2014-10-01',
			        		'endDate' => '2015-06-10',  
			        		'budgetEstimated' => '125000,45',  
			        		'organizationid' => '1'
			        	),
			        	array(
			        		'name' => 'Construcción de puente',
			        		'startDate' => '2014-06-01',
			        		'endDate' => '2015-01-10',  
			        		'budgetEstimated' => '200000,45',  
			        		'organizationid' => '2'
			        	),
			        	array(
			        		'name' => 'Conjunto residencial',
			        		'startDate' => '2015-10-01',
			        		'endDate' => '2015-05-28',  
			        		'budgetEstimated' => '225000,45',  
			        		'organizationid' => '3'
			        	),
			        	 
        	);

		DB::table('project')->insert( $projects );
    }
}