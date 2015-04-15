@if(Auth::user()->rol=='Administrator')
<br><br>
<div id="personalTypeError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
<h1>Crear/Editar tipo de personal</h1>
	<div class="panel">
		
		{{ Form::open(array('url'=>'personalType','class'=>'uniForm')) }}
		{{ Form::model($personalType,array('action' => array('PersonalTypeController@update', $personalType->id), 'method' => 'PUT', 'class'=>'uniForm')) }}	
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre')) }}
				</div>

				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('description', 'Descripcion' , array('class'=>'requiredField' )) }}
					{{ Form::text('description', null, array('class'=>'textInput textinput', 'placeholder'=>'Descripcion')) }}
				</div>

				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('hourCost', 'Costo / hora', array('class'=>'requiredField' )) }}
					{{ Form::text('hourCost', null, array('class'=>'textInput textinput', 'placeholder'=>'Costo por hora trabajada')) }}
				</div>

				 @if(Auth::user()->rol=='Administrator')
					<div class="buttonHolder">
						{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
					</div>
				 @else
				 	<div class="text-center">No tienen permisos para acceder</div>
				 @endif
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
@endif