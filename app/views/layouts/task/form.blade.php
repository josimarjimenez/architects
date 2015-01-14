<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h3 class="title-label">Nueva Tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
    {{ Form::open(array('url' => 'task', 'id' => 'taskForm')) }}  
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
              <input type="text" value="0" placeholder="00" name="hours" id="id_estimated_minutes_0">:<input type="text" value="00" name="minutes" id="id_estimated_minutes_1"> (HH:MM)
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
        <div class="modal-footer">
    <a class="btn hide track-time-button pull-left" href="/projects/enter_time/wuto-loja?task=" target="_blank">Track Time</a>    
    <a class="btn btn-success hide add-another-button" href="#" style="display: inline-block;">Save &amp; Add Another</a>    
     {{ Form::submit('Guardar', array('class' => 'button expand round')) }}   
</div>
   {{ Form::close() }}
</div>

<script type="text/javascript">
	$(document).ready(function() { 
		var form = $('#taskForm'); 
        form.bind('submit',function () {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                beforeSend: function(){
                    $('.before').append('<img src="images/loading.gif" />');
                },
                complete: function(data){
                    
                },
                success: function (data) {
                    $('.before').hide();
                    $('.errors_form').html('');
                    $('.success_message').hide().html(''); 
                    /*
                    if(data.success == false){
                        var errores = '';
                        for(datos in data.errors){
                            errores += '<small class="error">' + data.errors[datos] + '</small>';
                        }
                        $('.errors_form').html(errores)
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('.success_message').show().html(data.message)
                    }*/
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
	
</script>