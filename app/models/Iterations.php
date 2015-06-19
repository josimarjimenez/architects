<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Iterations extends Eloquent implements JsonSerializable{
	protected $table = 'iterations';
	protected $guarded = ['id', 'create_at', 'update_at'];

	use UserTrait, RemindableTrait;
	public static $rules = array(
		'name'=>'required|latino|min:2',
	    'start'=>'required',
	    'end'=>'required',
	    'estimatedBudget'=>'required|amount_major_cero|numeric',
	    'projectid'=>'required'
	);
 
	public static $messages = array(
      'name.required' => 'El nombre es obligatorio.',
      'name.min' => 'El nombre debe contener al menos dos caracteres.',
      'name.latino' => 'El nombre debe contener solamente letras y números',
      'start.required' => 'La fecha de inicio es obligatoria.',
      'end.required' => 'La fecha de fin es obligatoria',
      'estimatedBudget.required' => 'El presupuesto estimado es obligatorio.',
      'estimatedBudget.numeric' => 'El presupuesto estimado debe ser decimal.',
      'estimatedBudget.amount_major_cero' => 'El presupuesto estimado debe ser mayor a 0'
   	);

 	public function jsonSerialize(){ 
		//return (object) get_object_vars($this);
		return array(
             'id' => $this->id,
             'name' => $this->name,
             'start' => $this->start,
             'end' => $this->end,
             'summaryPoints' => $this->summaryPoints,
             'estimatedBudget' => $this->estimatedBudget,
             'realBudget' => $this->realBudget,
             'projectid' => $this->projectid,
             'realTime' => $this->realTime
        );
	} 

	public function projects() {
		return $this->belongsTo('Project','projectid');
	}

	public function aditionalSpent() {
		return $this->belongsTo('AditionalSpent','iterationid');
	}

	//issues
	public function issues() {
		return $this->hasMany('Issue','iterationid');
	}
}
?>