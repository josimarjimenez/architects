<div class="modal-header">    
    <button aria-hidden="true" data-dismiss="modal" class="close1" id="cerrarTarea" type="button">×</button>
    <h3 class="title-label">Nueva Tarea {{ Auth::user()->rol }}</h3>
</div>
<div class="modal-body edit-story-body">
    {{ Form::open(array('url' => 'task', 'id' => 'formularioTarea', 'class'=>'uniForm')) }}  
    <fieldset class="inlineLabels">
        <div id="div_id_name" class="ctrlHolder">
            <label for="name" class="control-label">Nombre</label>
            <div class="controls">
              <input type="text" value="" class="inputTask" name="name" id="name"> 
          </div>
      </div>

      <div id="div_id_name" class="ctrlHolder">
        <label for="summary" class="control-label">Resumen</label>
        <div class="controls">
           <textarea  class="inputTask" name="summary" id="summary"></textarea>
       </div>
   </div>

   <div id="div_id_name" class="ctrlHolder">
    <label for="inputEmail" class="control-label">Puntos</label>
    <div class="controls">
      <input type="text" value="" class="inputTask" name="points" id="points">
  </div>
</div>

<div id="div_id_name" class="ctrlHolder">
    <label for="inputEmail" class="control-label">Tiempo estimado (Horas)</label>
    <div class="controls">
      <input type="text" value="0"  class="inputTask" placeholder="00" name="timeEstimated" id="timeEstimated">
  </div>
</div>

<div id="div_id_name" class="ctrlHolder">
    <label for="inputEmail" class="control-label">Asignar a:</label>
    <div class="controls">
      <select class="inputTask" id="selAssignee" name="selAssignee">
        <option></option>                
        @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>    
        @endforeach
    </select>
</div>
</div>

<input type="hidden" name="issueid" id="issueid" value="">
<input type="hidden" name="rolId" id="rolId" value="{{Auth::user()->rol}}">
<div class="modal-footer">            
    {{ Form::submit('Guardar', array('class' => 'button expand round', 'id'=>'guardarTarea')) }}   
</div>
</fieldset>
{{ Form::close() }}
</div>

{{ HTML::script('packages/js/submitNewTask.js') }}