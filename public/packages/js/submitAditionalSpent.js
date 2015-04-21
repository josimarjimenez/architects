/************* FUNCIONES DE GASTOS ADICIONALES ***********/

$( "#acForm" ).submit(function( event ) {
  event.preventDefault();
  $.ajax({
    type: 'GET',
    url:  'http://192.168.1.3:8000/aditionalCost/save',
    data: $(this).serialize(),
    success: function (data) { 
        if(data.aditionalCost!=""){
          $('#listaGasto').css('display', "");
          //mostrar el gasto creado
          var insert = '<tr id="AS_'+data.aditionalCost.id+'">';
          insert += '<td>'+data.aditionalCost.description+'</td>';
          insert += '<td class="text-left">'+data.aditionalCost.total+'</td>';
          insert += '<td class="text-left"><a href="#" class="btn btn-danger blanco" onclick="deleteSpent('+data.aditionalCost.id+')">Eliminar</a></td>';
          insert += '</tr>'; 
          $('#listaGasto tbody').append(insert);

          //desaparecer el dialogo
          $("#chooseGasto").modal('hide');
          $('#chooseGasto').removeClass('z-index');
          $('#editTaskForm').css('z-index', '1500');

          //aumentar el total
          var total= Number($('#spentTotal').val());
          total += Number(data.aditionalCost.total);
          $('#spentTotal').val(total);
        }
      },
      error: function(errors){
        $('.before').hide();
        $('.errors_form').html('');
        $('.errors_form').html(errors);
      }
    });
});

/**
 * [deleteSpent eliminar el gasto adicional]
 * @param  {[int]} id [id del gasto]
 * @return {[type]}    [none]
 */
function deleteSpent(id){
  var r = confirm("Desea eliminar el registro?");
  if (r == true) {
    $.ajax({
    type: 'GET',
    url:  'http://192.168.1.3:8000/aditionalCost/delete',
    data: 'id='+id,
    success: function (data) { 
        $('#AS_'+id).remove();
    },
    error: function(errors){
        $('.before').hide();
        $('.errors_form').html('');
        $('.errors_form').html(errors);
      }
    });
  } 
}