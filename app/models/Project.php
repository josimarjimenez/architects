<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Project extends Eloquent implements UserInterface, RemindableInterface{
	protected $table = 'project';

	protected $guarded = ['id', 'created_at', 'updated_at'];
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:2', 
	    'startDate'=>'date', 
	    'endDate'=>'date'
    );

    protected $appends = array('auxName');

	//relationSHIP
	//organization
	public function organization() {
		return $this->belongsTo('Organizations','organizationid');
	}
	
	//iterations
	public function iterations() {
		return $this->hasMany('Iterations','projectid');
	}

	//teams
	public function teams(){
		return $this->belongsToMany('Teams', 'workIn', 'projectid', 'teamsid');
	}
}
?>