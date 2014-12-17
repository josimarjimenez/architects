<div id="body" class="container ">
	<a href="/materials/create" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i> 
	Nuevo material
	</a>
	<h1>Materiales de: {{ $organization->name }}</h1>
	<br>
	<table id="projects" style="width:60% !important" class="table table-bordered table-striped">
		<tbody>
			<tr>
				<th>Nombre</th>
				<th style="text-align:right">Costo</th>
				<th></th>
			</tr>
			@foreach ($organization->materials as $material)
			<tr>
				<td>{{ $material->name }}</td>
				<td>{{ $material->value }}</td>
				<td>
					{{ HTML::link('materials/'.$material->id.'/edit',  'Editar', array('class'=>"btn btn-medium btn-info")  ) }} 
					&nbsp
					{{ Form::open(array('url' => 'materials/' . $material->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
</div>