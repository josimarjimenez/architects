
<!-- DIALOGOS: GASTOS ADICIONALES -->
<div class="modal" id="chooseGasto" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px;">
	<form class="uniForm" id="acForm" action="http://localhost:8000/aditionalCost/save" > 
	    @include('layouts.task.aditionalSpent')
	    <div class="text-right" style="margin-right:20px; padding-top:10px">
	    	{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary', 'id'=>'aditionalBTN'))}}
	    	<button  class="btn btn-default" id="cerrarGasto">Cerrar</button>
	    </div> 
	</form>
</div>
<!-- DIALOGOS: MATERIAL -->
<div class="modal" id="chooseMaterial" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px;">
    @include('layouts.materials.choose')
    <div class="text-right" style="margin-right:20px;">
    	<button  class="btn btn-default" id="cerrarChoose">Cerrar</button>
    </div> 
</div>
<!-- DIALOGOS: PERSONAL -->
<div class="modal" id="choosePersonal" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px;">
    @include('layouts.personalTypes.choose')
    <div class="text-right" style="margin-right:20px;">
    	<button  class="btn btn-default" id="cerrarPersonal">Cerrar</button>
    </div> 
</div>

<!-- DIALOGOS: TAREA-NEW -->
<div class="modal" id="taskForm" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px; z-index:9100">
	@include('layouts.task.form')
</div>
<div sytle="clear:both"></div>

<!-- DIALOGOS: TAREA-EDITAR -->
<div class="modal" id="editTaskForm" style="margin-top: 0px; width: 800px; margin-left: -300px; height: 558px;">
	@include('layouts.task.editForm')
</div>

<!-- DIALOGOS: TASKBOARD -->
<div class="modal" id="myModal" style="margin-top: 0px; width: 1340px; margin-left: -670px; height: 496px; z-index:9000">
	@include('layouts.task.taskboard')
</div> 