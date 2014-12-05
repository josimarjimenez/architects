<?php 
class Teams extends Eloquent {
	
	// MASS ASSIGNMENT -------------------------------------------------------
	// define which attributes are mass assignable (for security)
	// we only want these 3 attributes able to be filled
	//protected $fillable = array('weight', 'bear_id');
 
	protected $table = 'teams';

	//relationSHIP
	public function users() {
		return $this->belongsToMany('User', 'memberof', 'teamid', 'userid');
	}

}

?>