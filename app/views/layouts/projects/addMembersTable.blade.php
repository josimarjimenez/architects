<legend>Miembros del proyecto: {{$project->name}}</legend>
{{ Form::open(array('url'=>'projects/asigned', 'class'=>'form-signup')) }}
	@foreach($users as $user)
		<div class="checkbox">
		  <label>
		    @if(in_array($user->id, $members))
		    {{ Form::checkbox('users_id[]', $user->id, true) }}
		    @else
		    {{ Form::checkbox('users_id[]', $user->id, false) }}
		    @endif
		    {{ $user->name . ' ' . $user->lastname . ' - ' . Functions::find($user->functionid)->name }}
		  </label>
		</div>
	@endforeach
	{{ Form::hidden('team_id', $team->id) }}
	{{ Form::hidden('project_id', $project->id) }}
	<div class="buttonHolder">
		{{ HTML::link('projects/'. $project->id,  'Salir', array('class'=>"btn btn-danger btn-sm")  ) }} 
		{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
	</div>
{{ Form::close() }}