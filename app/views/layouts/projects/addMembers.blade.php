<legend>Miembros del proyecto: {{$project->name}}</legend>
{{ Form::open(array('url'=>'projects/asigned', 'class'=>'form-signup')) }}
	<br>
	<div class="table-responsive">
	<table id="members" style="width:100% !important" class="table table-bordered table-striped" data-click-to-select="true">
		<tbody>
			<tr>
				<th data-field="state" data-checkbox="true"></th>
				<th data-field="name" style="width:1000px; text-align:left;">Nombres</th>
            	<th data-field="identification" style="width:800px; text-align:left;">Identificación</th>
            	<th style="width:800px; text-align:left">Cargo</th>
			</tr>
			@foreach($users as $user)
			<tr>
				<td>
					<label>
						@if(in_array($user->id, $members))
					    {{ Form::checkbox('users_id[]', $user->id, true) }}
					    @else
					    {{ Form::checkbox('users_id[]', $user->id, false) }}
					    @endif
					 </label>
				</td>
				<td style="width:180px; text-align:left">{{ $user->name }} {{ $user->lastname }} </td>
				<td style="width:180px; text-align:left">{{ $user->identification }}</td>
				<td style="width:180px; text-align:left">{{ Functions::find($user->functionid)->name }}</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
	</div>
	{{ Form::hidden('team_id', $team->id) }}
	{{ Form::hidden('project_id', $project->id) }}
	<div class="buttonHolder">
		{{ HTML::link('projects/'. $project->id,  'Salir', array('class'=>"btn btn-danger btn-sm")  ) }} 
		{{ Form::submit('Guardar  ', array('class'=>'btn btn-primary'))}}
	</div>
{{ Form::close() }}

