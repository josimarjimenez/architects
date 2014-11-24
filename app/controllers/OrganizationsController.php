<?php 

class OrganizationsController extends BaseController {
	protected $layout = "layouts.main";

	public function getNew() {
		$this->layout->content = View::make('layouts.organizations.organizationForm');
	}

	public function getIndex() {
		$this->layout->content = View::make('layouts.organizations.index');
	}

}
 ?>