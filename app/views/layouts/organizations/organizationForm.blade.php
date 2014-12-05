 <br><br>
<<<<<<< HEAD
<div id="selectOrganization">
	<div class="panel panel-default">
		<h1>ORGANIZATION</h1>

		{{ Form::open('register', 'post') }}

		{{ Form::label('name', 'Name') . Form::text('name', Input::old('name')) }}
		{{ Form::label('test', 'Test') . Form::text('test', Input::old('test')) }}
		{{ Form::label('logo', 'Logo') . Form::file('logo') }}}
		{{ Form::label('address', 'Address') . Form::text('address', Input::old('address')) }}
		{{ Form::label('webPage', 'WebPage') . Form::text('webPage', Input::old('webPage')) }}
		{{ Form::label('create_at', 'Create_at') . Form::time('create_at') }}
		{{ Form::label('update_at', 'Update_at') . Form::time('update_at') }}

		{{ Form::submit('ORGANIZATION')}}

		{{ Form::token() . Form::close() }}

	</div>
</div>
=======
 <div id="selectOrganization">
 	<div class="panel panel-default">
		{{ Form::open(array('url'=>'organizacion/crear', 'class'=>'form-signup')) }}
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
			{{ Form::label('test', 'test') }}
			{{ Form::text('test', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
 			{{ Form::label('logo', 'Logotipo') }}
			{{ Form::file('logo') }}

 		 	{{ Form::label('address', 'Dirección') }}
			{{ Form::text('address', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de la organización')) }}

			{{ Form::label('webPage', 'Sitio web') }}
			{{ Form::url('webPage', 'http://') }}

			{{ Form::submit('Guardar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
 		{{ Form::close() }}
 	</div>
 </div>

>>>>>>> 50d24fd8f4ae4fb061d5d6388049f4f63a6ebb53

