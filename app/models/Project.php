<?php 
class Project extends Eloquent {
	protected $table = 'project';



	//relationSHIP
	public function organization() {
		return $this->belongsTo('Organizations','organizationid');
	}
}
?>