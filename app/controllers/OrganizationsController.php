<?php 

class OrganizationsController extends BaseController {
	protected $layout = "layouts.main";

	public function getNew() {
		$this->layout->content = View::make('layouts.organizations.organizationForm');
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