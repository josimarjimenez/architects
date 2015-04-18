 <br><br>
 @if(Auth::user()->rol=='Administrator')
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
@endif