<?php 

class OrganizationsController extends BaseController {


	public function getNew() {
		$this->layout->content = View::make('layouts.users.register');
	}
}
 ?>