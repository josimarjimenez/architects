<div id="body" class="container ">
	<a href="/projects/create" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i> 
	Nuevo proyecto
	</a>
	<h1>Projecto de: {{ $organization->name }}</h1>
	<br>
	<table id="projects" class="table table-bordered table-striped">
		<tbody>
			<tr>
				<th>Proyecto</th>
				<th style="width: 120px;">Fecha de inicio</th>
				<th style="width: 140px; text-align:right">Fecha finalización</th>
				<th style="width: 180px; text-align:right">Presupuesto estimado</th> 
				<th style="width: 180px;"></th>
			</tr>
			@foreach ($organization->projects as $project)
			<tr>
				<td>
					{{ HTML::link('projects/project/'.$project->nameAux,   $project->name  ) }}
				</td>
				<td>{{ $project->startDate }}</td>
				<td>{{ $project->endDate }}</td>
				<td>{{ $project->budgetEstimated }}</td> 
				<td>
					{{ HTML::link('projects/edit/'.$project->id,  'Editar', array('class'=>"btn btn-medium btn-info")  ) }}
					{{ HTML::link('projects/delete/'.$project->id,  'Eliminar', array('class'=>"btn btn-danger btn-medium")  ) }}
				</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
</div>