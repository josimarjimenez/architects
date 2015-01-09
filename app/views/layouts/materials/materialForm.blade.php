<br><br>
<div id="projectError">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul> 
	<h1>Crear/Editar material</h1>
	<div class="panel">
		<?php 
			if($type == "new"){
		 ?>
		{{ Form::open(array('url'=>'materials','class'=>'uniForm')) }}
		<?php }else { ?>
		{{ Form::model($material,array('action' => array('MaterialsController@update', $material->id), 'method' => 'PUT', 'class'=>'uniForm')) }}	
		<?php } ?>
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('name', null, array('class'=>'textInput textinput', 'placeholder'=>'Nombre del material')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('quantity', 'Cantidad', array('class'=>'requiredField' )) }}
					{{ Form::text('quantity', null, array('class'=>'textInput textinput', 'placeholder'=>'Cantidad')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Precio', array('class'=>'requiredField' )) }}
					{{ Form::text('value', null, array('class'=>'textInput textinput', 'placeholder'=>'Precio')) }}
				</div>
				<div class="buttonHolder">
					{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
				</div>
				{{ Form::hidden('organizationid', $organization->id) }}
			</fieldset>
		{{ Form::close() }}
	</div>
</div>
