<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Validation\Validator;

class Material extends Eloquent{
	protected $table = 'material';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|latino|min:2',
	    'code'=>'alpha_num|unique:material',
	    'value'=>'required|amount_major_cero|numeric',
	    'startDate'=>'date',  
	    'endDate'=>'date'
    );

    public static $messages = array(
      'name.required' => 'El nombre es obligatorio.',
      'name.min' => 'El nombre debe contener al menos dos caracteres.',
      'name.latino' => 'El nombre debe contener solamente letras y números',
      'code.unique' => 'La código ingresado ya se encuentra registrado.',
      'value.required' => 'El precio unitario es obligatorio.',
      'value.numeric' => 'El precio unitario debe ser decimal.',
      'value.amount_major_cero' => 'Cantidad debe ser mayor a 0'
   	);

    public static function validate($data){
      $reglas = self::$rules;
      return Validator::make($data, $reglas);
   	}

	protected $appends = array('auxName');

	public function organization() {
		return $this->belongsTo('Organization','organizationid');
	}

	//projects
	public function project() {
		return $this->hasMany('Project','materialid');
	}

	//used
	public function tasks(){
		return $this->belongsToMany('Task', 'used', 'materialid', 'taskid');
	}

}
?>