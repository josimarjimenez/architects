<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Task extends Eloquent{
	protected $table = 'task';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_spaces|min:2', 
	    'summary'=>'required|alpha_spaces|min:2', 
	    'points'=>'required|alpha_spaces|min:2',
	    'value'=>'required|alpha_spaces|min:2',
    );

	protected $appends = array('auxName');

	public function issue() {
		return $this->belongsTo('Issue','issueid');
	}

	public function user() {
		return $this->belongsTo('User','userid');
	}

	public function scrumState() {
		return $this->belongsTo('ScrumState','scrumid');
	}
}
?>