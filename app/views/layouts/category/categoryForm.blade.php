@if(Auth::user()->rol=='Administrator')

	<div id="selectCategory">

 		<div class="panel panel-default">

			{{ Form::open(array('url'=>'categoria/ingresar', 'class'=>'form-signup')) }}
				{{ Form::label('name', 'Nombre') }}
				{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la Categoria')) }}
			 			
 				{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}

 			{{ Form::close() }}
	 	</div>
 	</div>
@endif