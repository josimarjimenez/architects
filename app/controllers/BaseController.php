<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	/*public function __construct() 
    {
        // Fetch the Site Settings object
       	$organization = Organization::find(10);
        View::share('organization', $organization);
    }*/

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
			/*
			$organization = Organization::find(10);
			$auxName = str_replace(" ",'-', $organization->name);
			
			->with('organization', $organization)
			->with('auxName', $auxName);
			*/
		}
	}

}
