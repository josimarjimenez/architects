<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Iterations extends Eloquent{
	protected $table = 'iterations';
	protected $guarded = ['id', 'create_at', 'update_at'];

	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:2', 
	    'start'=>'required',
	    'end'=>'required',
	    'projectid'=>'required'
	);
 
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