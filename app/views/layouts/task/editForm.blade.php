<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h3 class="title-label">Tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
    <form action="http://localhost:8000/tareas/editTask" id="editFormTask" >
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
        <input type="hidden" value="0" name="total" id="total">
        <input type="text" value="" name="listaIDS" id="listaIDS" />
        <div class="modal-footer">
           <!-- <a class="btn track-time-button pull-left" href="/projects/enter_time/wuto-loja?task=" target="_blank">Tiempo gastado</a> -->
        {{ Form::submit('Guardar', array('class' => 'button expand round')) }}   
    </div>
   </form>
</div>
<div class="modal" id="chooseMaterial" style="margin-top: 0px; width: 600px; margin-left: -300px; height: 358px;">
    @include('layouts.materials.choose')
    <a href="#" onclick="cerrarChoose()" class="btn">Cerrar</a>
</div>

<script type="text/javascript">
	$(document).ready(function() { 
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
                        $('.errors_form').html(errores)
                    
                    }else{
                        if(data.succes == 1){
                            
                            var msj = 'Tarea actualizada \n';
                            
                            alert(msj);
                            $("#editTaskForm").modal('hide');
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
        if($("#cu_"+id).length == 0){
             var insert = '<tr>';
            insert += '<td>'+nombre+'</td>';
            insert += '<td align="right">'+valor+'</td>';
            insert += '<td><input style="width:60px !important" type="text" name="cu_'+id+'" value="" id="cu_'+id+'" onkeyup="calcular('+id+', '+valor+');" /></td>';
            insert += '<td>';
            insert += '<input readonly style="width:60px !important"  type="text" value="" id="to_'+id+'" name="to_'+id+'" />';
            insert += '<input type="hidden" value="'+id+'" name="name_'+id+'" id="id_'+id+'" />';
            insert += '</td>';
            insert += '</tr>';
            $('#listaMateriales').append(insert);

            var valorId = $('#listaIDS').val();
            console.log(id);
            valorId+= " "+id;
            $('#listaIDS').val(valorId);
            
        } 
        $('#total').val(0)
    }

    function calcular(id, valor){ 
        var cantidad = $('#cu_'+id).val();
        var total = cantidad * valor;
        var totalSend = Number($('#total').val());
        $('#to_'+id).val(total); 
        totalSend += total;
        $('#total').val(totalSend)
    }
    function cerrarChoose(){
        $("#chooseMaterial").modal('hide');
    }
</script>