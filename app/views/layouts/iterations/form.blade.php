<div id="iterationError">
	@if($errors->all())
	<ul class="alert alert-error">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif

</div>

<h1>Crear/Editar iteración</h1>

@if($type == 'new')
{{ Form::open(array('url'=>'iterations','class'=>'uniForm')) }}
@else
{{ Form::model($iteration,array('action' => array('IssueController@update', $iteration->id), 'method' => 'PUT', 'class'=>'uniForm')) }}	
@endif
<div class="ctrlHolder" id="div_id_name">
	{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
	{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre de la iteración')) }}
</div>
<div class="ctrlHolder" id="div_id_name">
	{{ Form::label('start', 'Fecha de inicio', array('class'=>'requiredField' )) }}
	{{ Form::text('start', null, array('type' => 'text', 'class' => 'textInput textinput datepicker input-block-level','placeholder' => 'Fecha inicio', 'id' => 'start')) }}
</div>
<div class="ctrlHolder" id="div_id_name">
	{{ Form::label('end', 'Fecha fin', array('class'=>'requiredField' )) }}
	{{ Form::text('end', null, array('type' => 'text', 'class' => 'textInput textinput datepicker input-block-level','placeholder' => 'Fecha fin', 'id' => 'end')) }}
</div>
<div class="ctrlHolder" id="div_id_name">
	{{ Form::label('estimatedBudget', 'Presupuesto estimado', array('class'=>'requiredField' )) }}
	{{ Form::text('estimatedBudget', null, array('class'=>'textInput textinput', 'placeholder'=>'Presupuesto estimado para la iteración')) }}
</div>
<div class="buttonHolder">
	{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
</div>
	{{ Form::hidden('projectid', $project->id) }}
{{ Form::close() }}	
<script type="text/javascript">
$(document).ready(function() {
	$('#start').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		format:"yyyy-mm-dd"
	});

	$('#end').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		format:"yyyy-mm-dd"
	});
} );
</script>