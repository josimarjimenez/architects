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
		'name'=>'required|alpha_num_spaces|min:2',
	    'start'=>'required',
	    'end'=>'required',
	    'projectid'=>'required'
	);
 
 	public function jsonSerialize(){ 
		//return (object) get_object_vars($this);
		return array(
             'id' => $this->id,
             'name' => $this->name,
             'start' => $this->start,
             'end' => $this->end,
             'summaryPoints' => $this->summaryPoints,
             'summaryBudgets' => $this->summaryBudgets,
             'realBudget' => $this->realBudget,
             'projectid' => $this->projectid
        );
	} 

	public function projects() {
		return $this->belongsTo('Project','projectid');
	}

	public function aditionalSpent() {
		return $this->belongsTo('AditionalSpent','iterationid');
	}

	public function issues(){ 
		return $this->hasMany('Issue','iterationid');
	}
}
?>