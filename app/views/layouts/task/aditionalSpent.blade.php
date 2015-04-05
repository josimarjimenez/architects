<div style="width:95%; margin: 0 auto;">
	<p></p>
	<h1>Ingresar gastos adicionales</h1>
	<p></p>
	<br>
		<fieldset class="inlineLabels">
		<div class="ctrlHolder" id="div_id_name">
			{{ Form::label('description', 'Descripción', array('class'=>'requiredField bold' )) }}
			{{ Form::textarea('description', null, ['class' => 'textarea1 textinput datepicker input-block-level']) }}
		</div>
		<div class="ctrlHolder" id="div_id_name">
			{{ Form::label('total', 'Precio', array('class'=>'requiredField bold' )) }}
			{{ Form::text('total', null, ['class' => 'textInput  datepicker input-block-level']) }}
		</div>
		{{ Form::hidden('taskid', '', array('id' => 'taskid')) }}
	</fieldset>
</div>