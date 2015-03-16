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
    {{ $user->name . ' ' . $user->lastname }}
  </label>
</div>
@endforeach
{{ Form::hidden('team_id', $team->id) }}
{{ Form::hidden('project_id', $project->id) }}
{{ Form::submit('Guardar  ', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}