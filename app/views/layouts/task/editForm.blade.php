<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h3 class="title-label">Tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
    <form action="task.update" id="editFormTask">
        <div class="control-group">
            <label for="name" class="control-label">Nombre</label>
            <div class="controls">
              <input type="text" value="" style="width:300px" name="name" id="name"> 
            </div>
        </div>

         <div class="control-group">
            <label for="summary" class="control-label">Resumen</label>
            <div class="controls">
            	<textarea  style="width:300px" name="summary" id="summary"></textarea>
            </div>
        </div>

        <div class="control-group">
            <label for="inputEmail" class="control-label">Puntos</label>
            <div class="controls">
              <input type="text" value="" name="tags" id="txtTags">
            </div>
        </div>

        <div class="control-group">
            <label for="inputEmail" class="control-label">Estimado</label>
            <div class="controls">
              <input type="text" value="0" placeholder="00" name="timeEstimated" id="timeEstimated">
            </div>
        </div>

        <div class="control-group">
            <label for="inputEmail" class="control-label">Asignar a:</label>
            <div class="controls">
              <select style="width:120px" id="selAssignee" name="assignee">
                <option></option>                
                <option value="macartuche">macartuche</option>
              </select>
            </div>
        </div>
        <input type="hidden" name="issueid" id="issueid" value="">
        <input type="hidden" name="id" id="id" value="">
        <div class="control-group">
            <h1>Materiales</h1>
            <a href="#" id="addMaterial" onclick="abrirMateriales()" class="btn">Agregar material</a>
            <table id="listaMateriales" style="width:80%; display:none" class="table table-bordered table-striped" >
                <tr>
                    <td>Nombre</td>
                    <td>Precio unitario</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                </tr>
            </table>
        </div>
        
        <div class="modal-footer">
            <a class="btn track-time-button pull-left" href="/projects/enter_time/wuto-loja?task=" target="_blank">Tiempo gastado</a>
        {{ Form::submit('Guardar', array('class' => 'button expand round')) }}   
    </div>
   </form>
</div>
<div class="modal" id="chooseMaterial" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px;">
    @include('layouts.materials.choose')
    <a href="#" onclick="cerrarChoose()">Cerrar</a>
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
                        li += '<b> ('+task.userid+')</b>';
                        li += '</li>';

                    
                        $('#todo').append(li);
                        $( "#formularioTarea" )[0].reset();
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
});
	
    function abrirMateriales(){
        $("#chooseMaterial").modal({ // wire up the actual modal functionality and show the dialog
            "backdrop" : "static",
            "keyboard" : true,
            "show" : true // ensure the modal is shown immediately
        }); 
    }

    function udpateMaterial(id, nombre, valor){
        $('#listaMateriales').css('display','block');

        //chequear si existe el elemento
        if($("#pu_"+id).length == 0){
             var insert = '<tr>';
            insert += '<td>'+nombre+'</td>';
            insert += '<td align="right">'+valor+'</td>';
            insert += '<td><input style="width:60px !important" type="text" value="" id="pu_'+id+'" onkeyup="calcular('+id+', '+valor+');" /></td>';
            insert += '<td><input disabled="disabled" style="width:60px !important"  type="text" value="" id="to_'+id+'" /></td>';
            insert += '</tr>';
            $('#listaMateriales').append(insert);
        } 
    }

    function calcular(id, valor){
        
        var cantidad = $('#pu_'+id).val();
        var total = cantidad * valor;
        console.log(cantidad);
        console.log(total)
        $('#to_'+id).val(total); 
    }
    function cerrarChoose(){
        $("#chooseMaterial").modal('hide');
    }
</script>