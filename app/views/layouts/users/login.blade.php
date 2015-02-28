<div class="container narrow_body" id="body">
	{{ Form::open(array('url'=>'users/signin', 'class'=>'uniForm login-option-box', 'id'=>'login_login')) }}
	<fieldset class="inlineLabels">
		<div class="fixed-form-fields">
			<h1 class="form-signin-heading">Usuarios existentes</h1>
			
			<div class="ctrlHolder" id="div_id_username">
				{{ Form::label('mail', 'Usuario' , array('class'=>'requiredField' )) }}
				{{ Form::text('mail', null, array('class'=>'textInput textinput', 'placeholder'=>'Correo electrónico')) }}
			</div>
			<div class="ctrlHolder" id="div_id_password">
				{{ Form::label('password', 'Clave' , array('class'=>'requiredField' )) }}
				{{ Form::password('password', array('class'=>'textInput textinput', 'placeholder'=>'Contraseña')) }}	
			</div>
		</div>
		<div class="form_block">
			<div class="buttonHolder">
				{{ HTML::link('users/recoverpassword', 'Olvidaste tu contraseña', array('class'=>'secondaryAction')) }}	
				{{ Form::submit('Ingresar', array('class'=>'btn btn-success'))}}
			</div>
		</div>
	</fieldset> 
	{{ Form::close() }}

	<!-- Importar el formulario de creacion de usuarios -->
	<div class="login-option-box" id="login_new_user">
		@include('layouts.users.registerFrontal')
	</div>
</div>	