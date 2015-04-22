<br><br>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

<div id="projectError">
	@if($errors->all())
	<ul class="alert alert-error">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif
</div>


@if(Auth::user()->rol=='Administrator')	
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
					{{ Form::label('value', 'Precio unitario', array('class'=>'requiredField' )) }}
					{{ Form::text('value', null, array('class'=>'textInput textinput', 'placeholder'=>'Precio unitario' , 'id'=>'price')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Código', array('class'=>'requiredField'))}}
					{{ Form::text( 'code', null, array('class'=>'textInput textinput', 'placeholder'=>'Código',   'id' => 'code'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Dimensiones', array('class'=>'requiredField'))}}
					{{ Form::text('dimensions', null, array('class'=>'textInput textinput', 'placeholder'=>'Dimensiones', 'id'=>'dimensions'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Peso', array('class'=>'requiredField'))}}
					{{ Form::text('weight', null, array('class'=>'textInput textinput', 'placeholder'=>'Peso', 'id'=>'weight'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Obervaciones', array('class' => 'requiredField'))}}
					{{ Form::textArea('observation', null, array('class'=>'textInput textinput', 'placeholder'=>'Observaciones acerca del material', 'id'=>'observation')) }}
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
@endif

<script type="text/javascript">
	
	$(function() {
		
		$( "#price" ).keyup(function () { 
			$(this).val($(this).val().replace(/[^0-9\.]/g,''));
			if($(this).val().split(".")[2] != null || ($(this).val().split(".")[2]).length ){
				$(this).val($(this).val().substring(0, $(this).val().lastIndexOf(".")));
			}   
		});
	});
</script>