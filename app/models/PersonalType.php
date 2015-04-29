<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class PersonalType extends Eloquent{
	protected $table = 'personalType';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_num_spaces|min:3', 
	    'description'=>'alpha_spaces|min:2',
	    'hourCost' => 'required|foo|numeric',
	    'code'=>'alpha_num|unique:personalType'
    );

	public static $messages = array(
		'name.required' => 'El nombre es obligatorio',
		'name.min' => 'El nombre debe contener más de 3 caracteres',
		'name.alpha_num_spaces' => 'El nombre debe contener solamente letras y números',
		'hourCost.required' => 'Costo / hora es requerido',
		'hourCost.foo' => 'Costo / hora debe ser mayor a cero',
		'code.unique' => 'El código ingresado ya se encuentra registrado'
	);

	protected $appends = array('auxName');

	//assigned
	public function tasks(){
		return $this->belongsToMany('Task', 'assigned', 'personlTypeid', 'taskid');
	}
}
?>