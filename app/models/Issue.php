<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Issue extends Eloquent{
	protected $table = 'issue';
	protected $guarded = ['id', 'create_at', 'update_at'];

	use UserTrait, RemindableTrait;
	public static $rules = array(
	    'summary'=>'required|latino|min:2', 
	    'detail'=>'required|latino|min:2',
	    'points'=>'required|numeric|amount_major_cero',
	    'categoryid'=>'required',
	    'iterationid'=>'required',
	    'startDate'=>'date', 
	    'endDate'=>'date'
	);  

    public static $messages = array(
      'summary.required' => 'El resumen es obligatorio.',
      'summary.min' => 'El resumen debe contener al menos dos caracteres.',
      'summary.latino' => 'El resumen debe contener solamente letras y números',
      'detail.required' => 'El detalle es obligatorio.',
      'detail.min' => 'El detalle debe contener al menos dos caracteres.',
      'detail.latino' => 'El detalle debe contener solamente letras y números',
      'points.required' => 'La estimación en puntos para la historia son obligatoria.',
      'points.numeric' => 'La estimación en puntos para la historia deben ser enteros.',
      'points.amount_major_cero' => 'La estimación en puntos para la historia deben ser mayor a cero.',
      'categoryid.required' => 'Debe de seleccionar o ingresar una categoría',
      'iterationid.required' => 'Debe de seleccionar una iteración.'
   	);


	public function category(){
		return $this->hasOne('Category');
	}
 
 	public function tasks(){
		return $this->hasMany('Task', 'issueid');
	}
 	
    public function iterations() {
		return $this->belongsTo('Iterations','iterationid');
	}

}
?>