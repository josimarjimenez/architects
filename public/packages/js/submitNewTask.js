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
                var li = '<li class="task-view" data-task-id="'+task.id+'">';
                li += '<span class="task-toolbar">';
                li += '<a href="#" class="edit-link" onclick="editTask('+task.id+')">';
                li +='<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
                li += '</a>';
                li += '</span>';
                 
                if(rol=='Administrator'){
                    li += '<span class="task-toolbar">';
                    li += '<a href="#" class="delete-link"  onclick="deleteTask('+task.id+')">';
                    li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
                    li += '</a>';
                    li += '</span>';
                }    
                
                li += task.name+'<br >';
                li += task.summary;
                li += '<b> ('+data.username+')</b>';
                li += '</li>';


                $('#todo').append(li);
                $( "#formularioTarea" )[0].reset();
                $('#taskForm').modal('hide');
                //limpiamos el formulario
                $('.success_message').show().html(data.message);
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