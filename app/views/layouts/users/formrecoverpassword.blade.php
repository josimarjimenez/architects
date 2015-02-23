{{ Form::open(array('url' => 'users/sendpasswordrecovery', 'class' => 'form-signin')) }}

	<h2 class="form-signin-heading">Recuperar contraseña</h2>
	{{ Form::text('mail', null, array('class'=>'input-block-level', 'placeholder'=>'Correo electrónico')) }}
	{{ Form::submit('Enviar', array('class'=>'btn btn-large btn-primary btn-block')) }}
	
{{ Form::close() }}