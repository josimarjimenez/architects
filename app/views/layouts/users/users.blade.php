<div id="body" class="container">
	<a href="/users/new" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i> 
	Nuevo miembro
	</a>
	<h1>Miembros de: {{ $organization->name }}</h1>
	<br>
	<table id="users" class="table table-bordered table-striped">
		<tbody>
			<tr>
				<th style="width: 180px;">Nombres</th>
				<th style="width: 180px; text-align:right">Apellidos</th>
				<th style="width: 180px; text-align:right">Email</th> 
				<th style="width: 180px; text-align:right">Direccion</th> 
				<th style="width: 180px;"></th>
			</tr>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->lastname }}</td>
				<td>{{ $user->mail }}</td>
				<td>{{ $user->direction }}</td> 
				<td>
					{{ HTML::link('users/edit/'.$user->id,  'Editar', array('class'=>"btn btn-medium btn-info")  ) }}
					{{ HTML::link('users/delete/'.$user->id,  'Eliminar', array('class'=>"btn btn-danger btn-medium")  ) }}
				</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
</div>