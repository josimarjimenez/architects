 
 <div id="selectMaterials">

 	<div class="panel panel-default">

		{{ Form::open(array('url'=>'materiales/ingresar', 'class'=>'form-signup')) }}
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre del Material')) }}
			{{ Form::label('quantity', 'Cantidad') }}
			{{ Form::text('quantity', null, array('class'=>'input-block-level', 'placeholder'=>'Cantidad del Material')) }}
 			
 		 	{{ Form::label('value', 'Valor') }}
			{{ Form::text('value', null, array('class'=>'input-block-level', 'placeholder'=>'Valor del Material')) }}

			{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}
 		{{ Form::close() }}

 	</div>

 </div>