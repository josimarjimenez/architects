<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="modal-header">    
  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
  <h3 class="title-label">Registrar avance de la tare</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
  <form action="http://localhost:8000/tareas/editTask" id="editFormTask" class="uniForm">
    <fieldset class="inlineLabels">

      <div class="ctrlHolder">
        <label for="name" class="control-label">Nombre</label>
        <div class="controls">
          <input type="text" value="" class="inputTask" name="name" id="name" readonly="true"> 
        </div>
      </div>

      <div class="ctrlHolder">
        <label for="summary" class="control-label">Resumen</label>
        <div class="controls">
         <textarea  class="inputTask" name="summary" id="summary" readonly="true"></textarea>
       </div>
     </div>

     <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Puntos</label>
      <div class="controls">
        <input type="text" value="" name="tags" id="txtTags" readonly="true">
      </div>
    </div>

    <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Tiempo trabajado</label>
      <div class="controls">
        <input type="text" value="0" placeholder="00" name="timeworked" id="timeworked">
      </div>
    </div>

    <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Responsable:</label>
      <div class="controls">
        <select class="inputTask" id="selAssignee" name="selAssignee" readonly>
        </select>
      </div>
    </div>
    <input type="hidden" name="issueid" id="issueid" value="">
    <input type="hidden" name="id" id="id" value="">
   
  <div class="modal-footer"> 
    {{ Form::submit('Guardar', array('class' => 'button expand round', 'id'=>'guardarEditTF')) }}   
   {{ Form::button('Cancelar', array('class' => 'button expand round', 'id'=>'cancelarEdit')) }} 
 </div>
</fieldset>
</form>
</div>
<div style="clear:both"></div>
{{ HTML::script('packages/js/submitEditTask.js') }}
{{ HTML::script('packages/js/submitAditionalSpent.js') }}

<script type="text/javascript">
      $("#timeworked").keypress(function (e) {
         //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#errmsg").html("Digits Only").show().fadeOut("slow");
                   return false;
        }
       });
</script>
