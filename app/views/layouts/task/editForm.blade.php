<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="modal-header">    
  <!--<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>-->
  <h3 class="title-label">Editar tarea</h3>
</div>
<div class="modal-body edit-story-body" style="height: 218px; max-height: 218px;">
  <form action="/tareas/editTask" id="editFormTask" class="uniForm">
    <fieldset class="inlineLabels">
      {{ Form::hidden('state', '0', array('id' => 'state')) }}
      <div class="ctrlHolder">
        <label for="name" class="control-label">Nombre</label>
        <div class="controls">
          <input type="text" value="" class="inputTask" name="name" id="name"> 
        </div>
      </div>

      <div class="ctrlHolder">
        <label for="summary" class="control-label">Resumen</label>
        <div class="controls">
         <textarea  class="inputTask" name="summary" id="summary"></textarea>
       </div>
     </div>

     <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Puntos</label>
      <div class="controls">
        <input type="text" value="" name="points" id="points">
      </div>
    </div>

    <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Tiempo estimado (horas)</label>
      <div class="controls">
          <input type="text" value="0" placeholder="00" name="timeEstimated" id="timeEstimated" readonly="true">
      </div>
    </div>

    <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Tiempo trabajado (horas)</label>
      <div class="controls">
        <input type="text" value="0" placeholder="00" name="timeReal" id="timeReal">
      </div>
    </div>

    <div class="ctrlHolder">
      <label for="inputEmail" class="control-label">Asignar a:</label>
      <div class="controls">
        <select class="inputTask" id="selAssignee" name="selAssignee">
        </select>
      </div>
    </div>
    <input type="hidden" name="issueid" id="issueid" value="">
    <input type="hidden" name="id" id="id" value="">
    <div class="control-group" style="display:none">
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
              <th width="15%" >P.U.
              <th>Cant.</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <input type="hidden" value=" " name="listaIDS_M" id="listaIDS_M" />
      </div>
      <div id="tabs-2">
        <div class="text-right">
          <button type="button" id="addPersonal" onclick="abrirPersonal()" class="btn btn-primary btn-lg">Agregar personal</button>
        </div>
        <table id="listaPersonal" style="width:100%; display:none" class="table table-striped" >
          <thead>
            <tr>
              <th width="50%" >Nombre</th>
              <th width="15%" >P. H.
              <th>Cant.</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <input type="hidden" value=" " name="listaIDS_P" id="listaIDS_P" />
      </div>
      <div id="tabs-3">
        <div class="text-right">
          <button type="button" id="addAditionalSpent" onclick="abrirGasto()" class="btn btn-primary btn-lg">Agregar gasto adicional</button>
        </div>
        <table id="listaGasto" style="width:100%; display:none" class="table table-striped" >
          <thead>
            <tr>
              <th width="50%" >Descripcion</th>
              <th width="15%" >Precio</th>
              <th width="15%" ></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
       
      </div>
    </div> 
 {{ Form::hidden('canRegisterSpent', '0', array('id' => 'canRegisterSpent')) }}
  </div>

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
