<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Project extends Eloquent implements UserInterface, RemindableInterface, JsonSerializable{
	protected $table = 'project';

	protected $guarded = ['id', 'created_at', 'updated_at'];
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:2', 
	    'startDate'=>'date', 
	    'endDate'=>'date'
    );

    protected $appends = array('auxName');


	public function jsonSerialize(){ 
		//return (object) get_object_vars($this);
		return array(
             'name' => $this->name,
             'startDate' => $this->startDate,
             'endDate' => $this->endDate,
             'budgetSummary' => $this->budgetSummary,
             'budgetEstimated' => $this->budgetEstimated,
             'id' => $this->id
        );
	} 

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
	//public function teams(){
	//	return $this->belongsToMany('Teams', 'workIn', 'projectid', 'teamsid');
	//}

	public function team(){
		return $this->hasOne('Teams','projectid');
	}
}
?>