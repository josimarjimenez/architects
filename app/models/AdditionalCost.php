<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class AdditionalCost extends Eloquebt{
	protected $table = 'additionalCost';
	protected $guarded = ['id', 'create_at', 'update_at'];

	use UserTrait, RemindableTrait;

	public static $rules = array(
		'description'=>'alpha_spaces|min:10',
		'value'=>'required|numeric|min:2',
		'quantity'=>'required|numeric|min:2',
		'total'=>'required|numeric|min:2'
	);

	public static $messages = array(
		'description.required' => 'La descripción es obligatoria.',
      	'description.min' => 'La descripción debe contener al menos dos caracteres.',
      	'value.required' => 'El valor es obligatorio.',
      	'value.numeric' => 'El valor debe ser un entero o decimal.',
      	'quantity.required' => 'La catidad es obligatoria.',
      	'quantity.numeric' => 'La cantidad debe ser un entero o decimal'
	);



}

?>