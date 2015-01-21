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
	    'name'=>'required|alpha_spaces|min:2', 
	    'description'=>'required|alpha_spaces|min:2',
	    'hourCost'=>'required'
    );

	protected $appends = array('auxName');

	//used
	public function used(){
		return $this->belongsToMany('Assigned', 'materialid');
	}
}
?>