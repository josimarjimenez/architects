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
		$organizations = Organization::all();
		$projects = Organization::find(1)->projects; 
		$projects = Organization::find(1)->projects; 
		$orgs = Organization::where('name', 'asdfasdf');
 
		$this->layout->content = View::make('layouts.organizations.index')->with('projects', $projects)->with('org', $orgs);
	}
}
?>
