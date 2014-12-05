<?php 
class Rol extends Eloquent {
	
	// MASS ASSIGNMENT -------------------------------------------------------
	// define which attributes are mass assignable (for security)
	// we only want these 3 attributes able to be filled
	//protected $fillable = array('weight', 'bear_id');
 
	protected $table = 'rol';

	//relationSHIP
	public function users() {
		return $this->belongsToMany('User', 'belongsTo', 'rolid', 'userid');
	}

}


?>