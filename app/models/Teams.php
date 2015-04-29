<?php 
class Teams extends Eloquent {
	
	//use UserTrait, RemindableTrait;
	public  static $rules = array(
	    'name' => 'required|alpha|min:2',
	);

	public static $messages = array(
		'name.required' => 'El nombre es obligatorio',
	);

	protected $table = 'teams';

	//user
	public function users() {
		return $this->belongsToMany('User', 'memberof', 'teamid', 'usersid');
	}

	public function project()
    {
         //return $this->belongsTo('Project', 'projectid');
         return $this->belongsTo('Project');
    }


	//public function project()
    //{
    //    return $this->belongsTo('Project','projectid');
    //}

	//public function project()
    //{
    //    return $this->belongsTo('Project');
    //}
	//project
	//public function projects(){
	//	return $this->belongsToMany('Project', 'workIn', 'teamsid', 'projectid');
	//}
}

?>