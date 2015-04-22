<br><br>
<div id="personalTypeError">

	@if($errors->all())
	<ul class="alert alert-error">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif 

@if(Auth::user()->rol=='Administrator')	
	<h1>Crear / Editar tipo de personal</h1>
		<div class="panel">
			<?php 
				if($type == "new"){
		 	?>
			{{ Form::open(array('url'=>'personalType','class'=>'uniForm')) }}
			<?php }else { ?>
			{{ Form::model($personalType,array('action' => array('PersonalTypeController@update', $personalType->id), 'method' => 'PUT', 'class'=>'uniForm')) }}	
			<?php } ?>
				<fieldset class="inlineLabels">
					<div class="ctrlHolder" id="div_id_name">
						{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
						{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre')) }}
					</div>

					<div class="ctrlHolder" id="div_id_name">
						{{ Form::label('hourCost', 'Costo / hora', array('class'=>'requiredField' )) }}
						{{ Form::text('hourCost', null, array('class'=>'textInput textinput', 'placeholder'=>'Costo por hora trabajada')) }}
					</div>

					<div class="ctrlHolder" id="div_id_name">
						{{ Form::label('code', 'Code', array('class'=>'requiredField'))}}
						{{ Form::text('code', null, array('class' =>'textInput textinput', 'placeholder'=>'Código'))}}
					</div>

					<div class="ctrlHolder" id="div_id_name">
						{{ Form::label('description', 'Descripcion' , array('class'=>'requiredField' )) }}
						{{ Form::text('description', null, array('class'=>'textInput textinput', 'placeholder'=>'Descripción')) }}
					</div>

					@if(Auth::user()->rol=='Administrator')
						<div class="buttonHolder">
							{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
						</div>
					@endif
						{{ Form::hidden('organizationid', $organization->id) }}

				</fieldset>
						{{ Form::close() }}
		</div>
	</div>
@endif