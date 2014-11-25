{{ Form::open(array('url'=>'usuarios/create', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Registro de usuarios</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
    {{ Form::text('nombres', null, array('class'=>'input-block-level', 'placeholder'=>'Nombres')) }}
    {{ Form::text('apellidos', null, array('class'=>'input-block-level', 'placeholder'=>'Apellidos')) }}
    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de correo')) }}
    {{ Form::text('direccion', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de correo')) }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Contraseña')) }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm contraseña')) }}
 
    {{ Form::submit('Registrar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}