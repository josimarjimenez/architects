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


	//relationSHIP
	public function organization() {
		return $this->belongsTo('Organizations','organizationid');
	}
}
?>