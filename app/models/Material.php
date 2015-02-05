<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Material extends Eloquent{
	protected $table = 'material';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:2', 
	    'value'=>'required',
	    'startDate'=>'date', 
	    'endDate'=>'date'
    );

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