<?php 
class Teams extends Eloquent {
	
	use UserTrait, RemindableTrait;
	public  static $rules = array(
	    'nombres'=>'required|alpha|min:2',
	);

	protected $table = 'teams';

	//user
	public function users() {
		return $this->belongsToMany('User', 'memberof', 'teamid', 'userid');
	}

	//project
	public function projects(){
		return $this->belongsToMany('Project', 'workIn', 'teamsid', 'projectid');
	}
}

?>