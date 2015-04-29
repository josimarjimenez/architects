<?php

class PersonalTypeController extends BaseController {

	protected $layout = "layouts.main";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$personalTypes = PersonalType::all();
		$this->layout->content = View::make('layouts.personalTypes.personalTypes')
								->with('personalTypes', $personalTypes);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('layouts.personalTypes.create')
		->with('organization', app('organization')) 
		->with('type',  'new') ;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), PersonalType::$rules, PersonalType::$messages);
		if ($validator->passes()) { 
			$personalType = new PersonalType;
			$personalType->name = Input::get('name'); 
			$personalType->description = Input::get('description'); 
			$personalType->hourCost = Input::get('hourCost');
			$personalType->code = Input::get('code');
			$personalType->organizationid = Input::get('organizationid');  
			$personalType->save();
			return Redirect::to('personalType')
			->with('message', 'Registro creado con exito'); 
		}else{
			return Redirect::to('personalType/create')
			->with('error', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try {
			$personalType = PersonalType::findOrFail($id);
		}catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) { 
		    return Redirect::to('/personalType')
			->with('message', 'No existe el tipo de personal');
		}
		$this->layout->content = View::make('layouts.personalTypes.create')
		->with('personalType', $personalType)->with('type',  'edit');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$personalType = PersonalType::findOrFail($id);

		$rules = PersonalType::$rules;
		$rules['code'] .= ',code,' . $id;

		$validator = Validator::make(Input::all(), $rules, PersonalType::$messages);

		if ($validator->passes()) { 

			$personalType->fill(Input::all());
			$personalType->save();
			$organization=app('organization');
			return Redirect::to('/personalType')
				->with('message','Registro actualizado correctamente')
				->with('organization',$organization);
		}else{
			return Redirect::to('personalType/'.$id.'/edit')
			->with('error', 'Ocurrieron los siguientes errores')
			->withErrors($validator)
			->withInput();   	
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$personalType = PersonalType::find($id);
		if(sizeof($personalType->tasks) < 1){
			$personalType->delete();
			return Redirect::to('/personalType')
			->with('message', 'Registro eliminado')
			->with('organizacion', app('organization'));
		}else{
			return Redirect::to('/personalType')
			->with('error', 'El registro ya se encuentra como gasto dentro de las actividades.');
		}

		
	}

}
