<div id="body" class="container ">
	<a href="/materials/create" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i> 
	Nuevo material
	</a>
	<h1>Materiales de: {{ $organization->name }}</h1>
	<br>
	<table id="projects" class="table table-bordered table-striped">
		<tbody>
			<tr>
				<th style="width: 180px;">Nombre</th>
				<th style="width: 180px; text-align:right">Costo</th>
				<th style="width: 180px;"></th>
			</tr>
			@foreach ($materials as $material)
			<tr>
				<td>{{ $material->name }}</td>
				<td>{{ $material->valor }}</td>
				<td>
					{{ HTML::link('materials/'.$material->id.'/edit',  'Editar', array('class'=>"btn btn-medium btn-info")  ) }} 
					&nbsp
					{{ Form::open(array('url' => 'materials/' . $material>id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
</div>