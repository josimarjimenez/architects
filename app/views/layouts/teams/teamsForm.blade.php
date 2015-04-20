@if(Auth::user()->rol=='Administrator')
 <div id="selectTeams">

 	<div class="panel panel-default">

		{{ Form::open(array('url'=>'equipos/ingresar', 'class'=>'form-signup')) }}
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre del Equipo')) }}
			
			{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}
 		{{ Form::close() }}

 	</div>

 </div>
@endif