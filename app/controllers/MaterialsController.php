<?php
class MaterialsController extends BaseController {
	protected $layout = "layouts.main";

	public function create(){
		$this->layout->content = View::make('layouts.materials.materialForm')
		->with('organization', app('organization'))
		->with('type', 'new');
	}

	public function index(){
		$organization = app('organization');  
		$this->layout->content = View::make('layouts.materials.index')
								->with('organization', $organization);
	}


	public function store(){ 
	
		$validator = Validator::make(Input::all(), Material::$rules, Material::$messages);

		if($validator->passes()){
			$material = new Material;
			$material->name = Input::get('name'); 
			$material->value = Input::get('value');
			$material->code = Input::get('code');
			$material->dimensions = Input::get('dimensions');
			$material->weight = Input::get('weight');
			$material->observation = Input::get('observation');
			//$material->projectid = Input::get('projectid');
			$material->organizationid = Input::get('organizationid');  
			$material->save();

			$organization = app('organization'); 
			return Redirect::to('/materials/')
								->with('message', "Material ingresado con exito");
		}else{
			return Redirect::to('materials/create')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();
		}
		
	}

	public function edit($id){
		
		try {
			$material = Material::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
			$organization = app('organization');
		    return Redirect::to('/materials/')
			->with('message', 'No existe el material');
		}
		
		$this->layout->content = View::make('layouts.materials.materialForm')
								->with('organization', $material->organization)
								->with('material', $material)
								->with('type', "edti");
	}

	public function update($id){

		$material = Material::findOrFail($id);
        $rules = Material::$rules;
		$rules['code'] .= ',code,' . $id;

		$validator = Validator::make(Input::all(), $rules, Material::$messages);
		if($validator->passes()){
			$material->fill(Input::all());
			$material->save();
			$organization = app('organization');
			return Redirect::to('/materials')
				->with('message', 'Registro actualizado')
				->with('organization', $organization);

		}else{
			return Redirect::to('materials/'.$id.'/edit')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();
		}		

	}

	/*
	public function update($id){
		$project = Project::findOrFail($id);

		$validator = Validator::make(Input::all(), Project::$rules, Project::$messages);

		if ($validator->passes()) { 

			$project->fill(Input::all());
			$project->save();
			$organization = app('organization');
			return Redirect::to('organization/name/'.$organization->auxName.'/projects')
				->with('message', 'Registro actualizado');
		}else{
			return Redirect::to('projects/'.$id.'/edit')
			->with('message', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}
	*/

	public function destroy($id){
		$material = Material::find($id);
		$material->delete();  
		return Redirect::to('/materials')
		->with('message', 'Registro eliminado')
		->with('organization', app('organization'));
	}

	public function show($id){
		
	}

}
?>