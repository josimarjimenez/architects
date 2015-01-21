<div id="body" class="container">
	<a href="/personalType/create" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i>
	Nuevo
	</a>
	<h1>Tipo de personal</>
		<br>
		<table id="personalTypes" class="table table-bordered table-striped">
			<tbody>
				<tr>
					<th style="width:180px;">Nombre</th>
					<th style="width:180px; text-align:right">Descripcion</th>
					<th style="width:180px; text.align:right">Costo / hora</th>
					<th style="width:180px;"></th>
				</tr>
				@foreach($personalTypes as $personalType)
				<tr>
					<td>{{$personalType->name}}</td>
					<td>{{$personalType->description}}</td>
					<td>{{$personalType->hourCost}}</td>
					<td>
						<a class="btn btn-small btn-info" href="{{ URL::to('personalType/' . $personalType->id . '/edit') }}">Edit this Nerd</a>
						{{HTML::link('personalType/' . $personalType->id . '/edit', 'Editar', array('class'=>"btn btn-medium btn-info") )}}
						{{ Form::open(array('url' => 'personalType/' . $personalType->id, 'class' => 'pull-right')) }}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
						{{ Form::close() }}	
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
</div>