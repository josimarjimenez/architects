 
 <div id="selectOrganization">
<<<<<<< HEAD

 	<div class="panel panel-default">

		{{ Form::open(array('url'=>'organizacion/crear', 'class'=>'form-signup')) }}
=======
 	 <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul> 

 	<div class="panel panel-default">
		{{ Form::open(array('url'=>'organization/create','files'=>true, 'class'=>'form-signup')) }}
>>>>>>> 094c296db6770bf81335f0b04b141bafd291b928
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
			
			{{ Form::label('test', 'test') }}
			{{ Form::text('test', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre de la organizacion')) }}
 			
			{{ Form::label('image', 'Logotipo') }}
			{{ Form::file('image')  }}

 		 	{{ Form::label('address', 'Dirección') }}
			{{ Form::text('address', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección de la organización')) }}

<<<<<<< HEAD
			{{ Form::label('webPage', 'Sitio web') }}
			{{ Form::url('webPage', 'http://') }}

			{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}
=======
			 
			{{ Form::submit('Guardar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
>>>>>>> 094c296db6770bf81335f0b04b141bafd291b928
 		{{ Form::close() }}

 	</div>

 </div>
