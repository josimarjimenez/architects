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
	    'test'=>'required|alpha|min:2'
    );
	

	public function projects() {
		return $this->hasMany('Project','organizationid');
	}
}
?>