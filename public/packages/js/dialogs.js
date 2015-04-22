/****************************** DIALOGOS Y FUNCIONES DE GUARDADO *******************/


/**
 * [mostrarTaskboard description]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function mostrarTaskboard(id){
  $("#myModal").modal({
    "backdrop" : "static",
    "keyboard" : true,
    "show" : true 
  });

  var li = '';
  $.ajax({
    type: 'GET',
    url:  'http://192.168.0.16:8000/tareas/taskAll',
    data: 'id='+id,

    success: function (data) {
      $('.before').hide();
      $('.errors_form').html('');
      $('.success_message').hide().html(''); 

      $('#todo').empty();
      $('#haciendo').empty();
      $('#hecho').empty();
      var tasks = data.tasks; 

      var rol = "{{  Auth::user()->rol; }}" ;
      console.log(rol);

      $.each( tasks, function( key, value ) { 
        li = '';
        li += '<li class="task-view" id="'+value.id+'" >';
        li += '<span class="task-toolbar">';
        li += '<a href="#" class="edit-link" onclick="editTask('+value.id+')"> ';
        li += '<i class="icon-glyph icon-edit" title="Editar tarea"></i>';
        li += '</a>'
        li += '</span>'

        if(rol=='Administrator'){
          li += '<span class="task-toolbar">';
          li += '<a href="#" class="delete-link" onclick="deleteTask('+value.id+')">';
          li += '<i class="icon-glyph icon-trash" title="Borrar tarea"></i>';
          li += '</a>';
          li += '</span>';
        }
        
        li += value.name+'<br >';
        li += value.summary;
        li += '<b> ('+value.username+')</b>';
        li += '</li>';

        switch(value.scrumid){
          case 1:
            //todo
            $('#todo').append(li);    
            break;
            case 2:
            //haciendo
            $('#haciendo').append(li);    
            break;
            case 3:
            //hecho
            $('#hecho').append(li); 
            break;
          } 
        });       
},
error: function(errors){
  $('.before').hide();
  $('.errors_form').html('');
  $('.errors_form').html(errors);
}
});
$("#issueid").val(id);
}


  /**
   * [deleteTask eliminar la tarea]
   * @param  {[int]} id [id de la tarea]
   * @return {[type]}    [description]
   */
   function deleteTask(id){
    var r = confirm("Desea eliminar el registro?");
    if (r == true) {
      $.ajax({
        type: 'GET',
        url:  'http://192.168.0.16:8000/tareas/delete',
        data: 'id='+id,
        success: function (data) { 
          $('#'+id).remove();
        },
        error: function(errors){
          $('.before').hide();
          $('.errors_form').html('');
          $('.errors_form').html(errors);
        }
      });
    }
  }



/**
 * [abrirMateriales description] 
 */
 function abrirMateriales(){
  $("#chooseMaterial").modal({  
    "backdrop" : "static",
    "keyboard" : true,
    "show" : true 
  }); 
}

/**
 * [abrirPersonal description] 
 */
 function abrirPersonal(){
  $("#choosePersonal").modal({ 
    "backdrop" : "static",
    "keyboard" : true,
    "show" : true 
  }); 
}


/**
 * [abrirGasto description] 
 */
 function abrirGasto(){
  $("#chooseGasto").modal({ 
    "backdrop" : "static",
    "keyboard" : true,
    "show" : true 
  }); 

   //limpiar el form
   $('#acForm #description').val('');
   $('#acForm #total').val('');
   $("#taskid").val($("#editFormTask #id").val());
 }

/**
 * [udpateMaterial actualizar la lista de materiales luego de seleccionar]
 * @param  {[type]} id     [id de material]
 * @param  {[type]} nombre [nombre de material]
 * @param  {[type]} valor  [precio de material]
 * @return {[type]}        [none]
 */
 function udpateMaterial(id, nombre, valor){
  $('#listaMateriales').css('display', "");
    //chequear si existe el elemento
    if($("#cu_"+id).length == 0){
     var insert = '<tr>';
     insert += '<td>'+nombre+'</td>';
     insert += '<td class="text-left">'+valor+'</td>';
     insert += '<td><input style="width:60px !important" type="text" name="cuM_'+id+'" value="" id="cuM_'+id+'" onkeyup="calcular('+id+', '+valor+', \'M\');" /></td>';
     insert += '<td>';
     insert += '<input readonly style="width:60px !important"  type="text" value="" id="toM_'+id+'" name="toM_'+id+'" />';
     insert += '<input type="hidden" value="'+id+'" name="name_'+id+'" id="id_'+id+'" />';
     insert += '</td>';
     insert += '</tr>';
     $('#listaMateriales tbody').append(insert);
     var valorId = $('#listaIDS').val();
     valorId+= " "+id;
     $('#listaIDS').val(valorId);

   } 
   $('#total').val(0)
 }


/**
 * [udpatePersonal actualizacion de tabla de personal luego de seleccion]
 * @param  {[type]} id     [id de personal]
 * @param  {[type]} nombre [nombre de personal]
 * @param  {[type]} valor  [precio /hora por personal]
 * @return {[type]}        [none]
 */
 function udpatePersonal(id, nombre, valor){
  $('#listaPersonal').css('display', "");
  //chequear si existe el elemento 
  if($("#puP_"+id).length == 0){
   var insert = '<tr>';
   insert += '<td>'+nombre+'</td>';
   insert += '<td class="text-left">'+valor+'</td>';
   insert += '<td><input style="width:60px !important" type="text" name="cuP_'+id+'" value="" id="cuP_'+id+'" onkeyup="calcular('+id+', '+valor+', \'P\');" /></td>';
   insert += '<td>';
   insert += '<input readonly style="width:60px !important"  type="text" value="" id="toP_'+id+'" name="toP_'+id+'" />';
   insert += '<input type="hidden" value="'+id+'" name="idP_'+id+'" id="idP_'+id+'" />';
   insert += '</td>';
   insert += '</tr>';
   $('#listaPersonal tbody').append(insert);

 } 
}

/**
 * [calcular funcion para calcular totales de materiales y precio]
 * @param  {[type]} id    [id de material o personal]
 * @param  {[type]} valor [precio de material o personal]
 * @param  {[type]} label [etiqueta M=material P=personal]
 * @return {[type]}       [none]
 */
 function calcular(id, valor, label){
  var cantidad = $('#cu'+label+'_'+id).val();
  var total = cantidad * valor;

  //fijar total de cada fila
  $('#to'+label+'_'+id).val(total);
  //colocar los ids en la lista
  var ids= $('#listaIDS_'+label).val();

  if(checkNotIn(id, ids)){
    ids += id+" ";
    $('#listaIDS_'+label).val(ids);
  }
}

/**
 * [checkNotIn verifica que el id no este ya ingresado]
 * @param  {[type]} id     [id a verificar]
 * @param  {[type]} string [la cadena total]
 * @return {[type]}        [description]
 */
 function checkNotIn(id, string){ 
  return (string.indexOf(id) > -1 )? false: true;
}

/**
 * [mostrarTaskForm abrir el dialog de Nueva tarea]
 * @return {[type]} [description]
 */
 function mostrarTaskForm(){
      $("#taskForm").modal({ // wire up the actual modal functionality and show the dialog
        "backdrop" : "static",
        "keyboard" : true,
        "show" : true // ensure the modal is shown immediately
      }); 

  //esconder panel posterior y  mostrar actual
  $('#myModal').css('z-index','50');
}

/**
 * [editTask recuperar datos de una tarea y abrir dialogo de edicion de tarea]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function editTask(id){ 
  //recover task data
  $.ajax({
    type: 'GET',
    url:  'http://192.168.0.16:8000/tareas/getTask',
    data: 'id='+id,
    success: function (data) {
      $('#editFormTask #name').val(data.task.name);
      $('#editFormTask #summary').val(data.task.summary);
      $('#editFormTask #tags').val(data.task.points);
      $('#editFormTask #timeEstimated').val(data.task.timeEstimated);
      $('#editFormTask #issueid').val(data.task.issueid);
      $('#editFormTask #id').val(data.task.id); 

      //vaciar el select
      $('#editFormTask #selAssignee').empty();

      $.each( data.users, function( index, user ) {
        //alert(user.name);
        var o = new Option(user.name, user.id);
        if(data.task.userid ==  user.id){
          o.selected = true;
        }
        $('#editFormTask #selAssignee').append(o);
      });
    },
    error: function(errors){
      $('.before').hide();
      $('.errors_form').html('');
      $('.errors_form').html(errors);
    }
  });


  //levantar el dialogo
  $("#editTaskForm").modal({  
    "backdrop" : "static",
    "keyboard" : true,
    "show" : true  
  }); 

  //esconder un panel y  mostrar otro
  $('#myModal').css('z-index','50');

  //limpiar inputs
  $('#listaIDS_M').val();
  $('#listaIDS_P').val();
  
  //chequear si esta en la columna de hcho
  var state=$('li#'+id).parent().attr('id');
  if(state=="hecho"){
    $('#editTaskForm .control-group').css('display', 'block');
    //actualizar a 1 el input para registrar gastos
    $('#canRegisterSpent').val(1);
  }else{
    $('#editTaskForm .control-group').css('display', 'none');
    //actualizar a 1 el input para registrar gastos
    $('#canRegisterSpent').val(0);
  }

  //borrar las tablas de material, personal y gastos
  //tambien ocultarlas
  $('#listaMateriales tbody').empty();
  $('#listaPersonal tbody').empty();
  $('#listaGasto tbody').empty();

  $('#listaMateriales').css('display','none');
  $('#listaPersonal').css('display','none');
  $('#listaGasto').css('display','none');

}


$(document).ready(function() { 
  //eventos de botones de materiales, personal y gastos adicionales, tarea
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

  //boton de agregar personal
  $('#addPersonal').click(function(){
    $('#choosePersonal').css('z-index','1800');
    $('#editTaskForm').css('z-index','50');
  });

  //boton de agregar gasto adicional
  $('#addAditionalSpent').click(function(){
    $('#chooseGasto').css('z-index','1500');
    $('#editTaskForm').css('z-index','50');
  });

  //cerrar dialogo de seleccion de material
  $('#cerrarChoose').click(function(){
    $('#chooseMaterial').removeClass('z-index');
    $('#editTaskForm').css('z-index', '1500');
    $("#chooseMaterial").modal('hide');
  });

  //cerrar dialogo de seleccion de addMaterial
  $('#cerrarPersonal').click(function(){
    $('#choosePersonal').removeClass('z-index');
    $('#editTaskForm').css('z-index', '1500');
    $("#choosePersonal").modal('hide');
  });

  //cerrar dialogo de seleccion de addMaterial
  $('#cerrarGasto').click(function(){
    $('#chooseGasto').removeClass('z-index');
    $('#editTaskForm').css('z-index', '1500');
    $("#chooseGasto").modal('hide');
  }); 

  //cerrar tarea
  $('#cancelarEdit').click(function(){
    $("#editTaskForm").modal('hide');
    $('#myModal').css('z-index','9000');
  }); 
});  