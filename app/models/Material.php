<?php
class Material extends Eloquent{
	protected $table = 'material';
	protected $guarded = ['id', 'created_at', 'updated_at'];
	
	public function organization() {
		return $this->belongsTo('Organization','organizationid');
	}
}
?>