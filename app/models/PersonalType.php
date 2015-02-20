<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class PersonalType extends Eloquent{
	protected $table = 'personaltype';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:3', 
	    'description'=>'alpha_spaces|min:2',
	    'hourCost' => 'required|foo|numeric'
    );

	public static $messages = array(
		'name.required' => 'El nombre es obligatorio',
		'name.min' => 'El nombre debe contener más de 3 caracteres',
		'hourCost.required' => 'Costo / hora es requerido',
		'hourCost.foo' => 'Costo / hora debe ser mayor a cero'
	);

	protected $appends = array('auxName');

	//used
	public function used(){
		return $this->belongsToMany('Assigned', 'materialid');
	}
}
?>