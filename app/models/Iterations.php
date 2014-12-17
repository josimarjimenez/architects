<?php 

class Iterations extends Eloquent{
	protected $table = 'iterations';
 
	public function projects() {
		return $this->belongsTo('Project','projectid');
	}

	public function issues(){ 
		return $this->hasMany('Issue','iterationid');
	}
}
?>