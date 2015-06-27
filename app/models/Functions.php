<?php 

class Functions extends Eloquent{
	protected $table = 'functions';
  
	 public function users()
    {
        return $this->hasMany('User');
    }
}
?>