<?php 

class Issue extends Eloquent{
	protected $table = 'issue';
  

	public function project(){ 
		return $this->belongsTo('Iterations','iterationid');
	}
}
?>