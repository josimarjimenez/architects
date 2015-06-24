<?php 

class Functions extends Eloquent{
	protected $table = 'functions';
  

	public function issue(){ 
		return $this->belongsTo('Issue');
	}
}
?>