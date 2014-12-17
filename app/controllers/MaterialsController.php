<?php
class MaterialsController extends BaseController {
	protected $layout = "layouts.main";

	public function getCreate(){
		$this->layout->content = View::make('layouts.materials.materialForm')
		->with('organization', app('organization'));
	}

	public function getMaterials($name){
		$organization = app('organization');
		$materials = Material::all();
		$this->layout->content = View::make('layouts.materials.materials')
								->with('organization', $organization)
								->with('materials', $materials);
	}


	public function edit($id){
		/*
		try {
			$project = Project::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/organization/name/'.$organization->auxName.'/projects')
			->with('message', 'No existe el proyecto');
		}
		
		 
		$this->layout->content = View::make('layouts.projects.new')
		->with('project', $project)->with('type',  'edit')  ; */
	}

}
?>