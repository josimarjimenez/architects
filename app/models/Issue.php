<?php 

class Issue extends Eloquent{
	protected $table = 'issue';
	protected $guarded = ['id', 'create_at', 'update_at'];

	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'summary'=>'required|alpha_spaces|min:2', 
	    'detail'=>'required|alpha_spaces|min:2',
	    'budget'=>'required|alpha_spaces|min:2',
	    'currentState'=>'required|alpha_spaces|min:2',
	    'points'=>'required|alpha_spaces|min:2',
	    'labels'=>'required|alpha_spaces|min:2',
	    'iterationid'=>'required|alpha_spaces|min:2',
	    'startDate'=>'date', 
	    'endDate'=>'date'
	);  

	public function project(){ 
		return $this->belongsTo('Iterations','iterationid');
	}

	public function category(){
		return $this->hasOne('Category');
	}
}
?>