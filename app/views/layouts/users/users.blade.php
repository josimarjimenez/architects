<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/smoothness/jquery-ui.css">
<div id="body" class="container">
	<a href="/users/new" style="text-decoration:none; vertical-align:middle" 
	class="btn btn-success pull-right">
	<i class="icon-plus-sign"></i> 
	Nuevo miembro
	</a>
	<h1>Miembros de: {{ $organization->name }}</h1>
	<br>
	<ul id="messages" style='display:none'>
		<li id="message_1"><a onclick="$('#message_1').fadeOut(); return false;" href="#"><small>Limpiar</small></a><div id="mensaje"></div></li>
	</ul>
<br />
<div class="table-responsive">
	<table id="users" class="table table-bordered table-striped">
		<tbody>
			<tr >
				<th style="width: 180px;">Nombres</th>
				<th style="width: 180px;">Apellidos</th>
				<th style="width: 180px;">Identificación</th>
				<th style="width: 180px;">Email</th> 
				<th style="width: 180px;">Direccion</th> 
				<th style="width: 180px;"></th>
			</tr>
			@foreach ($users as $user)
			<tr id="{{ $user->id }}">
				<td>{{ $user->name }}</td>
				<td>{{ $user->lastname }}</td>
				<td>{{ $user->identification }}</td>
				<td>{{ $user->mail }}</td>
				<td>{{ $user->direction }}</td> 
				<td>
					{{ HTML::link('users/edit/'.$user->id,  'Editar', array('class'=>"btn btn-medium btn-info")  ) }}
					@if($user->id != Auth::user()->id)
					 <button type="button" onclick="eliminarUsuario({{ $user->id }})" class="btn btn-danger btn-medium">Eliminar</button> 
					@endif
				</td>
			</tr>
			@endforeach  
		</tbody>
	</table>
</div>
	<div id="dialog-confirm"></div>
</div>
<script type="text/javascript">
	function eliminarUsuario(id){
		$("#dialog-confirm").html("Desea eliminar el usuario");
		$("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "Modal",
        height: 250,
        width: 400,
        buttons: {
            "Yes": function () {
            	$.ajax({
		            type: 'GET',
		            url:  'http://localhost:8000/users/delete',
		            data: 'id='+id,
		            success: function (data) { 
		            	if(data.succes=='true'){
		            		$("#users tr:eq("+id+")").remove();	
		            	}
		            	$('#messages').css('display','block');
		            	$('#mensaje').html(data.message);
		            	 
		            },
		            error: function(errors){ 
		            }
		        });
                $(this).dialog('close'); 
            },
                "No": function () {
                $(this).dialog('close'); 
            }
        }
    });
	}
</script>