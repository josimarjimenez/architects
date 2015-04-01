<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close1" id="cerrarTarea" type="button">×</button>
    <h3 class="title-label">Nueva Tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
    {{ Form::open(array('url' => 'task', 'id' => 'formularioTarea', 'class'=>'uniForm')) }}  
    <fieldset class="inlineLabels">
        <div id="div_id_name" class="ctrlHolder">
            <label for="name" class="control-label">Nombre</label>
            <div class="controls">
              <input type="text" value="" style="width:300px" name="name" id="name"> 
            </div>
        </div>

        <div id="div_id_name" class="ctrlHolder">
            <label for="summary" class="control-label">Resumen</label>
            <div class="controls">
            	<textarea  style="width:300px" name="summary" id="summary"></textarea>
            </div>
        </div>

         <div id="div_id_name" class="ctrlHolder">
            <label for="inputEmail" class="control-label">Puntos</label>
            <div class="controls">
              <input type="text" value="" name="tags" id="txtTags">
            </div>
        </div>

         <div id="div_id_name" class="ctrlHolder">
            <label for="inputEmail" class="control-label">Estimado</label>
            <div class="controls">
              <input type="text" value="0" placeholder="00" name="timeEstimated" id="timeEstimated">
            </div>
        </div>

         <div id="div_id_name" class="ctrlHolder">
            <label for="inputEmail" class="control-label">Asignar a:</label>
            <div class="controls">
              <select style="width:120px" id="selAssignee" name="selAssignee">
                <option></option>                
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>    
                @endforeach
              </select>
            </div>
        </div>

        <input type="hidden" name="issueid" id="issueid" value="">
        <div class="modal-footer">            
        {{ Form::submit('Guardar', array('class' => 'button expand round', 'id'=>'guardarTarea')) }}   
    </div>
    </fieldset>
   {{ Form::close() }}
</div>
 

<script type="text/javascript">
	$(document).ready(function() { 

        $( "#formularioTarea" ).submit(function( event ) { 
            event.preventDefault(); 

            $.ajax({
                type: 'POST',
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: function(){
                    //$('.before').append('<img src="images/loading.gif" />');
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
                            li += '<a href="#" class="edit-link">';
                                li +='<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
                            li += '</a>';
                            li += '<a href="#" class="delete-link">';
                                li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
                            li += '</a>';
                        li += '</span>';
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

        $('#cerrarTarea').click(function(){
            $('#myModal').css('z-index','9000');
        });

        $('#guardarTarea').click(function(){
            $('#myModal').css('z-index','9000');
        });

        //boton de agregar material
        $('#addMaterial').click(function(){
            $('#chooseMaterial').css('z-index','1500');
            $('#editTaskForm').css('z-index','50');
            
        });

        //cerrar dialogo de seleccion de material
        $('#cerrarChoose').click(function(){
            $('#chooseMaterial').removeClass('z-index');
            $('#editTaskForm').css('z-index', '1500');
            $("#chooseMaterial").modal('hide');
        });

         //cerrar dialogo de seleccion de material
        $('#cerrarPersonal').click(function(){
            $('#choosePersonal').removeClass('z-index');
            $('#editTaskForm').css('z-index', '1500');
            $("#cerrarPersonal").modal('hide');
        });                                                                                                                                                                                                                                                                                     
        //boton de agregar personal
        $('#addPersonal').click(function(){
            $('#choosePersonal').css('z-index','1800');
            $('#editTaskForm').css('z-index','50');
            
        });
        
	});
	
</script>