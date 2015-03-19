<?php
class ScrumStatesController extends BaseController{
	protected $layout = "layouts.main";

	public function getIndex(){
		$scrumStates = ScrumState::all();
		$this->layout->content = View::make('layouts.scrumstates.index')->with('scrumStates', $scrumStates);
	}

}
?>