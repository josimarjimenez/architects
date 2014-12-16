<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Organization extends Eloquent implements UserInterface, RemindableInterface{
	protected $table = 'organization';

	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_num|min:2', 
	    'image'=>'mimes:jpg,png'
    );

    protected $appends = array('auxName');
	

	public function projects() {
		return $this->hasMany('Project','organizationid');
	}
}
?>