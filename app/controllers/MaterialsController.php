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
	
		$validator = Validator::make(input::all(), Material::$rules);

		if($validator->passes()){
			$material = new Material;
			$material->name = Input::get('name'); 
			$material->quantity = Input::get('quantity');
			$material->value = Input::get('value');  
			$material->organizationid = Input::get('organizationid');  
			$material->save();

			$organization = app('organization'); 
			return Redirect::to('/materials/name')
								->with('organization', $organization->auxName.'/material')
								->with('message', "Material ingresado con exito");
		}else{
			return Redirect::to('materials/create');
			>with('message', 'Ocurrieron los siguientes errores')
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
		$material->fill(Input::all());
		$material->save();
		$organization = app('organization');
		return Redirect::to('/materials')
			->with('message', 'Registro actualizado')
			->with('organization', $organization);

	}

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