// SUBMIT DE FORMULARIO id=formularioTarea

$( "#formularioTarea" ).submit(function( event ) { 
    event.preventDefault(); 
 
    var rol =$('#rolId').val();
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
                $('.errors_form').html(errores)

            }else{
                var task = data.task;  
                //fijar en la parte de atras la tarea
                var li = '<li class="task-view" style="font-size:11pt" data-task-id="'+task.id+'" id="'+task.id+'" >';
                li += '<span class="task-toolbar">';
                li += '<a href="#" class="edit-link" onclick="editTask('+task.id+')">';
                li +='<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
                li += '</a>';
                li += '</span>';
                 
                if(rol=='Administrator'){
                    var css="";
                    if(data.task.scrumid==1){
                        css="display:inline-block";
                    }
                    
                    li += '<span class="task-toolbar" >';
                    li += '<a href="#" class="delete-link"  style="'+css+'" onclick="deleteTask('+task.id+')">';
                    li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
                    li += '</a>';
                    li += '</span>';
                }    
                
                li += task.name+'<br >';
                li += 'Responsable: <b>'+data.username+'</b><br >';
                li += '<b>Tiempo</b> (Horas):<br >';
                li += 'Planificado: '+task.timeEstimated+' Trabajado: '+task.timeReal+' Restante: '+task.timeRemaining;
                li += '</li>';



                $('#todo').append(li);
                $( "#formularioTarea" )[0].reset();
                $('#taskForm').modal('hide');
                //limpiamos el formulario
                $('.success_message').show().html(data.message);
                $.bootstrapGrowl("Tarea creada correctamente.", { type: 'success' });
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