//inicializar tabs 
$( "#tabs" ).tabs();
//submit editar tarea
$( "#editFormTask" ).submit(function( event ) { 
	event.preventDefault(); 
	$.ajax({
		type: 'POST',
		url:  $(this).attr('action'),
		data: $(this).serialize(),
		beforeSend: function(){
		},
		complete: function(data){ 
		},
		success: function (data) {
			$('.before').hide();
			$('.errors_form').html('');
			$('.success_message').hide().html(''); 
			if(data.success == false){
				var errores = '';
				for(datos in data.errors){
					errores += '<small class="error">' + data.errors[datos] + '</small>';
				}
				$('.errors_form').html(errores);
			}else{
				if(data.succes == 1){
					var msj = 'Tarea actualizada \n';
					$("#editTaskForm").modal('hide');
    				$('#myModal').css('z-index','9000');

    				//actualizar el taskboard
    				$('li#'+data.task.id).html('');
    				
    				var li = '';
    				if(data.final=='no'){
	    				li += '<span class="task-toolbar">';
		                li += '<a href="#" class="edit-link" onclick="editTask('+data.task.id+')">';
		                li +='<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
		                li += '</a>';
					// el administrador elimina la tarea	   
		                li += '<a href="#" class="delete-link" onclick="deleteTask('+data.task.id+')">';
		                li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
		                li += '</a>';
		                li += '</span>';
	                }
	                li += data.task.name+'<br >';
	                li += data.task.summary;
	                li += '<b> ('+data.user.name+')</b>';
	    			$('li#'+data.task.id).append(li);
				}
			} 
		},
		error: function(errors){
			$('.before').hide();
			$('.errors_form').html('');
			$('.errors_form').html(errors);
		}
	});
	return false;
}); 