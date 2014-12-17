<?php 

class OrganizationsController extends BaseController {
	protected $layout = "layouts.main";

	public function getNew() {
		$this->layout->content = View::make('layouts.organizations.organizationForm');
	}

	public function postCreate(){

		$validator = Validator::make(Input::all(), Organization::$rules);
		if ($validator->passes()) {

			//Upload the logo 
    		$file = Input::file('image');
			$upload_success = Input::file('image')
			->move('public/uploads', $file->getClientOriginalName());

			//save the register
			$organization = new Organization;
			$organization->name = Input::get('name'); 
			$organization->test = Input::get('test'); 
			$organization->logo = $file->getClientOriginalName();
			$organization->address = Input::get('address'); 
			$organization->save();
			return Redirect::to('organization/new')
			->with('message', 'Registro creado con exito'); 


		}else{
			return Redirect::to('organization/new')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
		
	}

	public function getIndex() { 
		$this->layout->content = View::make('layouts.organizations.index')  ;
	}

	/**
	 * Show all projects of one enterprise 
	 **/
	public function getName($name){ 
 

		$organization = app('organization'); 
		
		setlocale(LC_MONETARY, 'en_US');
		foreach ($organization->projects as $project) {
			$project->nameAux = str_replace(" ",'-', $project->name);
			$project->nameAux = $this->stripAccents($project->nameAux);
			$project->budgetEstimated = money_format('%(#10n',  $project->budgetEstimated);
		}
		
		$this->layout->content = View::make('layouts.organizations.projects')
								->with('organization', $organization);
	}


	/**
	*Show all members of one enterprise
	**/
	public function getMembers($name){
		$organization = app('organization');
		$users = User::all();
		$this->layout->content = View::make('layouts.users.users')
								->with('organization', $organization)
								->with('users', $users);

	}

	/**
	* Replace accents 
	**/
	private function stripAccents($str) {
    	return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}
}
 ?>