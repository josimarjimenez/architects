<br><br>
<div id="projectError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
	<h1>Crear material</h1>
	<div class="panel">
		{{ Form::open(array('url'=>'materials/create','class'=>'uniForm')) }}
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre del material')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('budget', 'Precio', array('class'=>'requiredField' )) }}
					{{ Form::text('budget', null, array('class'=>'textInput textinput', 'placeholder'=>'Precio')) }}
				</div>
				<div class="buttonHolder">
					{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
				</div>
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
