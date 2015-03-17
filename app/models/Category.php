<?php 

class Category extends Eloquent{
	protected $table = 'category';
  

	public function issue(){ 
		return $this->belongsTo('Issue');
	}
}
?>