@if(Auth::user()->rol=='Administrator')
<div id="selectRol">

 	<div class="panel panel-default">

		{{ Form::open(array('url'=>'rol/ingresar', 'class'=>'form-signup')) }}
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre del Rol')) }}
			{{ Form::label('description', 'Descripcion') }}
			{{ Form::text('description', null, array('class'=>'input-block-level', 'placeholder'=>'Descripcion del Rol')) }}
 			
 			{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}

 		{{ Form::close() }}

 	</div>

 </div>
 @endif