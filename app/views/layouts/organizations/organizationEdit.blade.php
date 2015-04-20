 
 <div id="selectOrganization">
 
 	 <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul> 

 	<h1>Editar Organización</h1>
	<div class="panel">
		{{ Form::open(array('url'=>'organization/update','files'=>true, 'class'=>'uniForm')) }}
		<fieldset class="inlineLabels">
			<div class="ctrlHolder" id="div_id_name">
				{{ Form::label('name', 'Nombre', array('class'=>'requiredField' ))  }}
				{{ Form::text('name', $organization->name, array('class'=>'textInput textinput', 'placeholder'=>'Nombres')) }}
			</div>

			<div class="ctrlHolder" id="div_id_name">
				{{ Form::label('image', 'Logotipo') }}
				{{ Form::file('image')  }}	
				<div style="text-align:center">Actualmente: {{ $organization->logo }}</div>
			</div>

			<div class="ctrlHolder" id="div_id_name">
 		 	{{ Form::label('address', 'Dirección') }}
			{{ Form::text('address', $organization->address,array('class'=>'textInput textinput',	'placeholder'=>'Dirección de la organización')) }}
			</div>

			<div class="ctrlHolder" id="div_id_name"> 
			{{ Form::label('webPage', 'Sitio web') }}
			{{ Form::url('webPage', $organization->webPage) }}
			{{ Form::hidden('id', $organization->id) }}

			@if(Auth::user()->rol=='Administrator')
				</div>
				{{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary btn-block'))}}
			@else
				<div class="text-center">No tienen permisos para acceder</div>
			@endif

		</fieldset>
 		{{ Form::close() }}

 	</div>
 
