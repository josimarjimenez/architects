<br><br>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<div id="projectError">
	@if($errors->all())
	<ul class="alert alert-error">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif 
	<h1>Mi perfil</h1>
	<div class="panel">
		{{ Form::open(array('url'=>'users/update/'.$user->id,'class'=>'uniForm')) }}
			<fieldset class="inlineLabels">
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('name', 'Nombre' , array('class'=>'requiredField' )) }}
					{{ Form::text('nombres', $user->name , array('class'=>'textInput textinput', 'placeholder'=>'Nombres')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Apellidos', array('class'=>'requiredField' )) }}
					{{ Form::text('apellidos', $user->lastname, array('class'=>'textInput textinput', 'placeholder'=>'Apellidos')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', "Identificación", array('class' =>'requiredField'))}}
					{{ Form::text('identification', $user->identification, array('class'=>'textInput textinput', 'placeholder'=>'Identificación'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value','Teléfono', array('class'=>'requiredField', ))}}
					{{ Form::text('telefono', $user->phone, array('class'=>'textInput textInput', 'placeholder'=>'Teléfono'))}}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Correo', array('class'=>'requiredField' )) }}
					{{ Form::text('mail', $user->mail, array('class'=>'textInput textinput', 'placeholder'=>'Dirección de correo')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Dirección', array('class'=>'requiredField' )) }}
					{{ Form::text('direccion', $user->direction, array('class'=>'textInput textinput', 'placeholder'=>'Dirección')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Password', array('class'=>'requiredField' )) }}
					{{ Form::password('password', array('class'=>'textInput textinput', 'placeholder'=>'Contraseña')) }}
				</div>
				<div class="ctrlHolder" id="div_id_name">
					{{ Form::label('value', 'Password confirmación', array('class'=>'requiredField' )) }}
					{{ Form::password('password_confirmation', array('class'=>'textInput textinput', 'placeholder'=>'Confirmar contraseña')) }}
				</div>
				<div class="buttonHolder">

					{{ HTML::link('/users/dashboard',  'Cancelar', array('class'=>"btn btn-danger btn-sm")  ) }} 

					{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
				</div>
				{{ Form::hidden('myprofile', true) }}
				{{ Form::hidden('organizationid', $organization->id) }}
			</fieldset>
			{{ Form::close() }}
		</div>
	</div>

	<script type="text/javascript">
	
	$(function() {
		
		$( "#price" ).keyup(function () { 
			$(this).val($(this).val().replace(/[^0-9\.]/g,''));
			if($(this).val().split(".")[2] != null || ($(this).val().split(".")[2]).length ){
				$(this).val($(this).val().substring(0, $(this).val().lastIndexOf(".")));
			}   
		});

        $('#ident').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });

	});

	function muestraMensaje() {
		var valor = $('#ident').val();
		alert('Gracias por pinchar ' + valor);
	}

	</script>