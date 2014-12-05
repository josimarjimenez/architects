<?php 

class Organization extends Eloquent {
	protected $table = 'organization';

	//relationSHIP
	public function projects() {
		return $this->hasMany('Project','organizationid');
	}
}
?>