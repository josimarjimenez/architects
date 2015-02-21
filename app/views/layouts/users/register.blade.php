{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Registro de usuarios</h2>
    @if($errors->all())
    <ul class="alert alert-error">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif 
    {{ Form::text('nombres', null, array('class'=>'input-block-level', 'placeholder'=>'Nombres')) }}
    {{ Form::text('apellidos', null, array('class'=>'input-block-level', 'placeholder'=>'Apellidos')) }}
    {{ Form::text('mail', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de correo')) }}
    {{ Form::text('direccion', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección')) }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Contraseña')) }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm contraseña')) }}
 
    {{ Form::submit('Registrar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}