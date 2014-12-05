 <br><br>
 <div id="selectOrganization">
 	 <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul> 

 	<div class="panel panel-default">
		{{ Form::open(array('url'=>'organization/create','files'=>true, 'class'=>'form-signup')) }}
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
			
			{{ Form::label('test', 'test') }}
			{{ Form::text('test', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
 			
			{{ Form::label('image', 'Logotipo') }}
			{{ Form::file('image')  }}

 		 	{{ Form::label('address', 'Dirección') }}
			{{ Form::text('address', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de la organización')) }}

			 
			{{ Form::submit('Guardar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
 		{{ Form::close() }}
 	</div>
 </div>


