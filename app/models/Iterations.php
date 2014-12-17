<?php 

class Iterations extends Eloquent{
	protected $table = 'iterations';
 
	public function projects() {
		return $this->belongsTo('Project','projectid');
	}
}
?>