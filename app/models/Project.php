<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Project extends Eloquent implements UserInterface, RemindableInterface, JsonSerializable{
	protected $table = 'project';

	protected $guarded = ['id', 'created_at', 'updated_at'];
	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'name'=>'required|alpha_num_spaces|min:2',
	    'budgetEstimated' => 'required',
	    'startDate'=>'date|required|before:endDate', 
	    'endDate'=>'date|required'
    );

	public static $messages = array(
		'name.required' => 'El nombre es obligatorio',
		'name.min' => 'El nombre debe contener al menos dos caracteres.',
		'name.alpha_num_spaces' => 'El nombre debe contener solamente letras y números',
		'budgetEstimated.required' => 'El presupuesto estimado es obligatorio',
		'startDate.required' => 'La fecha de inicio es obligatoria',
		'endDate.required' => 'La fecha de finalización es obligatoria',
		'startDate.before' => 'La fecha de inicio debe ser menor a la fecha de fin'
	);

    protected $appends = array('auxName');


	public function jsonSerialize(){ 
		//return (object) get_object_vars($this);
		return array(
             'name' => $this->name,
             'startDate' => $this->startDate,
             'endDate' => $this->endDate,
             'budgetReal' => $this->budgetReal,
             'budgetEstimated' => $this->budgetEstimated,
             'id' => $this->id
        );
	} 

	//relationSHIP
	//organization
	public function organization() {
		return $this->belongsTo('Organizations','organizationid');
	}
	
	//iterations
	public function iterations() {
		return $this->hasMany('Iterations','projectid');
	}

	public function team()
    {
      return $this->hasOne('Teams', 'projectid');
    }

	//teams
	//public function teams(){
	//	return $this->belongsToMany('Teams', 'workIn', 'projectid', 'teamsid');
	//}

}
?>