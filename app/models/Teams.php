<?php 
class Teams extends Eloquent {
	
	use UserTrait, RemindableTrait;
	public  static $rules = array(
	    'nombres'=>'required|alpha|min:2',
	);

	// MASS ASSIGNMENT -------------------------------------------------------
	// define which attributes are mass assignable (for security)
	// we only want these 3 attributes able to be filled
	//protected $fillable = array('weight', 'bear_id');
 
	protected $table = 'teams';

	//relationSHIP
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