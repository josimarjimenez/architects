<br><br>

<div id="materialError">
	<ul>
		@foreach( $errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
<h1>Crear/Editar tipo personal</h1>
	<div class="panel">
		<?php 
			if($type == "new"){
		 ?>
		{{ Form::open(array('url'=>'projects','files'=>true, 'class'=>'uniForm')) }}
		<?php }else { ?>
		{{ Form::model($project,array('action' => array('ProjectsController@update', $project->id), 'method' => 'PUT', 'class'=>'uniForm')) }}	
		<?php } ?>
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

				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('observation', 'Observaciones', array('class'=>'requiredField' )) }}
					{{ Form::textArea('observation', null, array('class'=>'textInput textinput', 'placeholder'=>'Observaciones del proyecto')) }}
				</div>

				{{ Form::hidden('organizationid', $organization->id) }}

				@if(Auth::user()->rol=='Administrator')
					<div class="buttonHolder">
						{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
					</div>
				@endif

			</fieldset>
		{{ Form::close() }}

	</div>
</div>	