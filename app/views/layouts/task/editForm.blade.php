<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h3 class="title-label">Editar tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
    <form action="http://localhost:8000/tareas/editTask" id="editFormTask" class="uniForm">
        <fieldset class="inlineLabels">

            <div class="ctrlHolder">
                <label for="name" class="control-label">Nombre</label>
                <div class="controls">
                  <input type="text" value="" style="width:300px" name="name" id="name"> 
              </div>
          </div>

          <div class="ctrlHolder">
            <label for="summary" class="control-label">Resumen</label>
            <div class="controls">
            	<textarea  style="width:300px" name="summary" id="summary"></textarea>
            </div>
        </div>

        <div class="ctrlHolder">
            <label for="inputEmail" class="control-label">Puntos</label>
            <div class="controls">
              <input type="text" value="" name="tags" id="txtTags">
          </div>
      </div>

      <div class="ctrlHolder">
        <label for="inputEmail" class="control-label">Estimado</label>
        <div class="controls">
          <input type="text" value="0" placeholder="00" name="timeEstimated" id="timeEstimated">
      </div>
  </div>

  <div class="ctrlHolder">
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

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Materiales</a></li>
            <li><a href="#tabs-2">Personal</a></li>
            <li><a href="#tabs-3">Gastos Adicionales</a></li>
        </ul>
        <div id="tabs-1">
         <div class="text-right">
            <button type="button" id="addMaterial" onclick="abrirMateriales()" class="btn btn-primary btn-lg">Agregar material</button>
         </div>
         <table id="listaMateriales" style="width:100%; display:none" class="table table-striped" >
            <thead>
                <tr>
                    <th width="50%" >Nombre</th>
                    <th width="15%" >Precio <br>unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="tabs-2">
         <button type="button" id="addPersonal" onclick="abrirPersonal()" class="btn btn-primary btn-lg">Agregar personal</button>
           <table id="listaPersonal" style="width:100%; display:none" class="table table-striped" >
            <thead>
                <tr>
                    <th width="50%" >Nombre</th>
                    <th width="15%" >Precio <br>hora</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="tabs-3">
        <p>33.</p>
    </div>
</div> 

</div>
<input type="hidden" value="0" name="total" id="total">
<input type="text" value="" name="listaIDS" id="listaIDS" />
<div class="modal-footer">
 <!-- <a class="btn track-time-button pull-left" href="/projects/enter_time/wuto-loja?task=" target="_blank">Tiempo gastado</a> -->
 {{ Form::submit('Guardar', array('class' => 'button expand round')) }}   
</div>
</fieldset>
</form>
</div>
<div style="clear:both"></div>

<script type="text/javascript">
$(document).ready(function() { 
    $( "#tabs" ).tabs();


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

    function abrirPersonal(){
        $("#choosePersonal").modal({ // wire up the actual modal functionality and show the dialog
            "backdrop" : "static",
            "keyboard" : true,
            "show" : true // ensure the modal is shown immediately
        }); 
    }

    function udpateMaterial(id, nombre, valor){

        $('#listaMateriales').css('display', "");

        //chequear si existe el elemento
        if($("#cu_"+id).length == 0){
           var insert = '<tr>';
           insert += '<td>'+nombre+'</td>';
           insert += '<td class="text-left">'+valor+'</td>';
           insert += '<td><input style="width:60px !important" type="text" name="cu_'+id+'" value="" id="cu_'+id+'" onkeyup="calcular('+id+', '+valor+');" /></td>';
           insert += '<td>';
           insert += '<input readonly style="width:60px !important"  type="text" value="" id="to_'+id+'" name="to_'+id+'" />';
           insert += '<input type="hidden" value="'+id+'" name="name_'+id+'" id="id_'+id+'" />';
           insert += '</td>';
           insert += '</tr>';
           $('#listaMateriales tbody').append(insert);

           var valorId = $('#listaIDS').val();
           console.log(id);
           valorId+= " "+id;
           $('#listaIDS').val(valorId);

       } 
       $('#total').val(0)
   }


    function udpatePersonal(id, nombre, valor){
        console.log(1);
    }


   function calcular(id, valor){ 
        var cantidad = $('#cu_'+id).val();
        var total = cantidad * valor;
        var totalSend = Number($('#total').val());
        $('#to_'+id).val(total); 
        totalSend += total;
        $('#total').val(totalSend)
    }

</script>
