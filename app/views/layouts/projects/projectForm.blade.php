<br><br>
<div id="projectError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
<h1>Crear proyecto</h1>
	<div class="panel">
		{{ Form::open(array('url'=>'projects.store','files'=>true, 'class'=>'uniForm')) }}
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre del proyecto')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('startDate', 'Fecha de inicio', array('class'=>'requiredField' )) }}
					{{ Form::text('startDate', null, array('type' => 'text', 'class' => 'textInput textinput datepicker input-block-level','placeholder' => 'Fecha inicio', 'id' => 'startDate')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('endDate', 'Fecha fin', array('class'=>'requiredField' )) }}
					{{ Form::text('endDate', null, array('type' => 'text', 'class' => 'textInput textinput datepicker input-block-level','placeholder' => 'Fecha fin', 'id' => 'endDate')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('budgetEstimated', 'Presupuesto', array('class'=>'requiredField' )) }}
					{{ Form::text('budgetEstimated', null, array('class'=>'textInput textinput', 'placeholder'=>'Presupuesto del proyecto')) }}
				</div>
				{{ Form::hidden('organizationid', $organization->id) }}
				<div class="buttonHolder">
					{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

	$('#startDate').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		format: "yyyy-mm-dd"
	});

	$('#endDate').datepicker({
		clearBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		format: "yyyy-mm-dd"
	});

} );
</script>